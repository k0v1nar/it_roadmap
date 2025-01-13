<?php

namespace App\Components\admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        return view('admin.user.template.index', [
            'meta_title' => 'Пользователи',
            'users' => $users
        ]);
    }

    public function add() {
        return view('admin.user.template.add-edit', [
            'meta_title' => 'Добавление пользователя'
        ]);
    }

    public function confirmAdd(Request $request) {
        $messages = [
            'nickname.required' => 'Введите никнейм.',
            'nickname.unique' => 'Никнейм должен быть уникальным.',
        ];
        $request->validate([
            "nickname" => 'required|unique:users,nickname',
            "login" => 'required|unique:users,login',
            "password" => 'required|min:6',
            "path_icon" => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);
        
        $path_icon = null;
        if ($request->hasFile('path_icon')) {
            $path_icon = $request->file('path_icon')->store('icons', 'public');
        }

        $user = User::create([
            "nickname" => $request->nickname,
            "login" => $request->login,
            "password" => $request->password,
            "path_icon" => $path_icon, // Сохраняем путь к иконке
        ]);
        
        if (isset($user)) {
            return redirect()->route('admin.user.finish', ['type' => 'add', 'id' => $user->id]);
        } else {
            return back()->withErrors(['errors' => 'Ошибка создания пользователя']);
        }
    }

    public function edit($id) {
        $user = User::find($id);
        return view('admin.user.template.add-edit', [
            'meta_title' => 'Изменение пользователя',
            'user' => $user
        ]);
    }

    public function confirmEdit(Request $request) {
        $messages = [
            'id.required' => 'Не хорошо лазить в коде)',
            'id.exists' => 'Не хорошо лазить в коде)',
            'nickname.required' => 'Введите никнейм.',
            'nickname.unique' => 'Никнейм должен быть уникальным.',
        ];
        
        $request->validate([
            "id" => 'required|exists:users,id',
            "nickname" => 'required|unique:users,nickname,' . $request->id,
            "login" => 'required|unique:users,login,' . $request->id,
            "password" => 'nullable|min:6',
            "path_icon" => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);
        
        $user = User::find($request->id);
        $user->nickname = $request->nickname;
        $user->login = $request->login;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        // Обработка иконки
        if ($request->hasFile('path_icon')) {
            // Удаляем старую иконку, если она есть
            if ($user->path_icon) {
                Storage::disk('public')->delete($user->path_icon);
            }
            // Сохраняем новую иконку
            $user->path_icon = $request->file('path_icon')->store('icons', 'public');
        }

        $user->save();
        
        return redirect()->route('admin.user.finish', ['type' => 'edit', 'id' => $user->id]);
    }

    public function delete($id) {
        $user = User::find($id);
        return view('admin.user.template.delete', [
            'meta_title' => 'Удаление пользователя',
            'user' => $user
        ]);
    }

    public function confirmDelete($id) {
        
        $user = User::find($id);

        // Удаляем иконку, если она существует
        if ($user->path_icon) {
            Storage::disk('public')->delete($user->path_icon);
        }

        // Удаляем пользователя
        $user->delete();
        return redirect()->route('admin.user.finish', ['type' => 'delete', 'id' => $id]);
    }

    public function finish($type, $id) {
        $user = User::find($id);
        return view("admin.user.template.finish", [
            'meta_title' => 'Завершение действия с пользователями',
            'user' => $user,
            "type" => $type
        ]);
    }
}
