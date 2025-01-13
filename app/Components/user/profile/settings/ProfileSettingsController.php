<?php

namespace App\Components\user\profile\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileSettingsController extends Controller
{
    public function index()
    {
        $user = User::auth();
        return view('user.profile.settings.template.index', [
            'meta_title' => 'Настройки аккаунта',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = User::auth();
        // Валидация данных с учетом уникальности никнейма
        $request->validate([
            'nickname' => 'required|string|max:255|unique:users,nickname,' . $user->id, // Никнейм обязателен, уникален и до 255 символов
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Иконка необязательна, но должна быть изображением
            'current_password' => $request->filled('new_password') ? 'required' : 'nullable', // Текущий пароль обязателен только при изменении пароля
            'new_password' => 'nullable|min:6|confirmed', // Новый пароль необязателен, минимум 8 символов и подтверждение
        ], [
            'nickname.required' => 'Пожалуйста, укажите никнейм.',
            'nickname.string' => 'Никнейм должен быть строкой.',
            'nickname.max' => 'Никнейм не может превышать 255 символов.',
            'nickname.unique' => 'Этот никнейм уже занят. Выберите другой.',
            'icon.image' => 'Загруженный файл должен быть изображением.',
            'icon.mimes' => 'Иконка должна быть в формате jpeg, png, jpg или gif.',
            'icon.max' => 'Размер иконки не должен превышать 2 МБ.',
            'current_password.required' => 'Пожалуйста, введите текущий пароль для изменения пароля.',
            'new_password.min' => 'Новый пароль должен содержать не менее 6 символов.',
            'new_password.confirmed' => 'Подтверждение пароля не совпадает.',
        ]);
    
        // Получение текущего пользователя
        if (!$user) {
            return redirect()->route('login')->withErrors(['auth' => 'Необходима авторизация.']);
        }
    
        // Обновление никнейма
        $user->nickname = $request->input('nickname');
    
        // Обновление иконки
        if ($request->hasFile('icon')) {
            // Удаление старой иконки, если существует
            if ($user->path_icon && Storage::disk('public')->exists($user->path_icon)) {
                Storage::disk('public')->delete($user->path_icon);
            }
            // Сохранение новой иконки
            $path = $request->file('icon')->store('icons', 'public');
            $user->path_icon = $path;
        }
    
        // Проверка текущего пароля только если новый пароль заполнен
        if ($request->filled('new_password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'Неверный текущий пароль.']);
            }
    
            // Обновление пароля
            $user->password = Hash::make($request->input('new_password'));
        }
    
        // Сохранение изменений
        $user->save();
    
        return redirect()->route('profile.settings.index')->with('success', 'Настройки успешно обновлены.');
    }
    

}
