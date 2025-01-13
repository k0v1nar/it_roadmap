<?php

namespace App\Components\admin\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\RoleAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function index() {
        $admins = Admin::with('role')->paginate(10);
        return view('admin.admin.template.index', [
            'meta_title' => 'Администраторы',
            'admins' => $admins
        ]);
    }

    public function add() {
        $roles = RoleAdmin::all();
        return view('admin.admin.template.add-edit', [
            'meta_title' => 'Добавление администратора',
            'roles' => $roles
        ]);
    }

    public function confirmAdd(Request $request) {
        $messages = [
            'nickname.required' => 'Введите никнейм администратора.',
            'login.required' => 'Введите логин администратора.',
            'login.unique' => 'Логин должен быть уникальным.',
            'password.required' => 'Введите пароль администратора.',
            'path_icon.file' => 'Загрузите файл изображения.',
            'path_icon.mimes' => 'Изображение должно быть формата: jpeg, png, jpg, gif, svg.',
            'path_icon.max' => 'Размер изображения не должен превышать 2MB.',
        ];
    
        $request->validate([
            "nickname" => 'required',
            "login" => 'required|unique:admins,login',
            "password" => 'required',
            "role_id" => 'required|exists:roles_admin,id',
            "path_icon" => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // Добавляем валидацию для иконки
        ], $messages);

        $path_icon = null;
        if ($request->hasFile('path_icon') && $request->file('path_icon')->isValid()) {
            $path_icon = $request->file('path_icon')->store('admins', 'public');
        }
    
        $admin = Admin::create([
            "nickname" => $request->nickname,
            "login" => $request->login,
            "password" => $request->password,
            "role_id" => $request->role_id,
            "path_icon" => $path_icon, // Сохраняем путь к иконке
        ]);

        if ($admin) {
            return redirect()->route('admin.admin.finish', ['type' => 'add', 'id' => $admin->id]);
        } else {
            return back()->withErrors(['errors' => 'Ошибка создания администратора']);
        }
    }

    public function edit($id) {
        $admin = Admin::find($id);
        $roles = RoleAdmin::all();
        return view('admin.admin.template.add-edit', [
            'meta_title' => 'Изменение администратора',
            'admin' => $admin,
            'roles' => $roles
        ]);
    }

    public function confirmEdit(Request $request) {
        $messages = [
            'id.required' => 'Не хорошо лазить в коде)',
            'id.exists' => 'Не хорошо лазить в коде)',
            'nickname.required' => 'Введите никнейм администратора.',
            'login.required' => 'Введите логин администратора.',
            'login.unique' => 'Логин должен быть уникальным.',
        ];
    
        $request->validate([
            "id" => 'required|exists:admins,id',
            "nickname" => 'required',
            "login" => 'required|unique:admins,login,' . $request->id,
            "role_id" => 'required|exists:roles_admin,id',
            "path_icon" => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // Добавляем валидацию для иконки
        ], $messages);
    
        $admin = Admin::find($request->id);
        $admin->nickname = $request->nickname;
        $admin->login = $request->login;
        $admin->role_id = $request->role_id;
    
        // Если введен новый пароль, обновляем его
        if ($request->password) {
            $admin->password = $request->password;
        }
        // Если была загружена новая иконка, удаляем старую иконку, если она есть
        if ($request->hasFile('path_icon') && $request->file('path_icon')->isValid()) {
            if ($admin->path_icon && Storage::disk('public')->exists($admin->path_icon)) {
                Storage::disk('public')->delete($admin->path_icon); // Удаляем старую иконку
            }
            // Сохраняем новый файл
            $admin->path_icon = $request->file('path_icon')->store('admins', 'public');
        }
        $admin->save();

        return redirect()->route('admin.admin.finish', ['type' => 'edit', 'id' => $admin->id]);
    }

    public function delete($id) {
        $admin = Admin::find($id);
        return view('admin.admin.template.delete', [
            'meta_title' => 'Удаление администратора',
            'admin' => $admin
        ]);
    }

    public function confirmDelete($id) {
        $admin = Admin::find($id);
        if ($admin && $admin->path_icon) {
            if (Storage::disk('public')->exists($admin->path_icon)) {
                Storage::disk('public')->delete($admin->path_icon); // Удаляем файл иконки
            }
        }
        Admin::where('id', $id)->delete();
        return redirect()->route('admin.admin.finish', ['type' => 'delete', 'id' => $id]);
    }

    public function finish($type, $id) {
        $admin = ($type == 'delete') ? (object) ['nickname' => $id] : Admin::find($id);
        return view("admin.admin.template.finish", [
            'meta_title' => 'Завершение операции',
            'admin' => $admin,
            'type' => $type
        ]);
    }
}
