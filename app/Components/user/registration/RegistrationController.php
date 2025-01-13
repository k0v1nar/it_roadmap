<?php

namespace App\Components\user\registration;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index() {
        if (User::isUser()) {
            return redirect()->route('main');
        }
        return view('user.registration.template.index', [
            'meta_title' => 'Регистрация'
        ]);
    }

    public function registrate(Request $request) {
        // Сообщения об ошибках для валидации
        $messages = [
            'login.required' => 'Введите логин.',
            'login.unique' => 'Этот логин уже занят.',
            'nickname.required' => 'Введите никнейм.',
            'nickname.unique' => 'Этот никнейм уже занят.',
            'icon.image' => 'Загруженный файл должен быть изображением.',
            'icon.mimes' => 'Иконка должна быть в формате jpeg, png, jpg или gif.',
            'icon.max' => 'Размер иконки не должен превышать 2 МБ.',
            'password.required' => 'Введите пароль.',
            'password.min' => 'Пароль должен содержать не менее 6 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];

        // Валидация данных
        $request->validate([
            'login' => 'required|unique:users,login',
            'nickname' => 'required|unique:users,nickname',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|min:6|confirmed',
        ], $messages);

        // Получаем данные из запроса
        $login = $request->login;
        $nickname = $request->nickname;
        $password = $request->password;

        // Создание нового пользователя
        $user = User::create([
            'login' => $login,
            'nickname' => $nickname,
            'password' => Hash::make($password),
        ]);

        // Обработка иконки, если она была загружена
        if ($request->hasFile('icon')) {
            // Сохранение иконки
            $path = $request->file('icon')->store('icons', 'public');
            $user->path_icon = $path;
            $user->save();
        }

        // Перенаправление на страницу после регистрации
        return redirect()->route('main');
    }
}