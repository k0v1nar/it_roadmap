<?php

namespace App\Components\admin\role;

use App\Http\Controllers\Controller;
use App\Components\admin\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\RoleAdmin;

class RoleController extends Controller {
    public function index() {
        $roles = RoleAdmin::paginate(10);
        return view('admin.role.template.index', [
            'meta_title' => 'Роли',
            'roles' => $roles
        ]);
    }

    public function add() {
        return view('admin.role.template.add-edit', [
            'meta_title' => 'Добавление роли'
        ]);
    }

    public function confirmAdd(Request $request) {
        $messages = [
            'name.required' => 'Введите название роли.',
            'name.unique' => 'Название роли должно быть уникальным.',
        ];
        $request->validate([
            "name" => 'required|unique:roles_admin,name'
        ], $messages);
        $role = RoleAdmin::create(["name"=>$request->name]);
        if (isset($role)) {
            return redirect()->route('admin.role.finish', ['type' => 'add', 'id' => $role->id]);
        }
        else {
            return back()->withErrors(['errors' => 'Ошибка создания роли']);
        }
    }

    public function edit($id) {
        $role = RoleAdmin::find($id);
        return view('admin.role.template.add-edit', [
            'meta_title' => 'Изменение роли',
            'role' => $role
        ]);
    }

    public function confirmEdit(Request $request) {
        $messages = [
            'id.required' => 'Не хорошо лазить в коде)',
            'id.exists' => 'Не хорошо лазить в коде)',
            'name.required' => 'Введите название роли.',
            'name.unique' => 'Название роли должно быть уникальным.',
        ];
        $request->validate([
            "id" => 'required|exists:roles_admin,id',
            "name" => 'required|unique:roles_admin,name'
        ], $messages);
        $role = RoleAdmin::find($request->id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('admin.role.finish', ['type' => 'edit', 'id' => $role->id]);
    }

    public function delete($id) {
        if ($id == 1) {
            return view('unknown');
        }
        $role = RoleAdmin::find($id);
        $countAdmins = Admin::where("role_id", $role->id)->count();
        return view('admin.role.template.delete', [
            'meta_title' => 'Удаление роли',
            'role' => $role,
            'countAdmins' => $countAdmins
        ]);
    }

    public function confirmDelete(Request $request) {
        $messages = [
            'id.required' => 'Не хорошо лазить в коде)',
            'id.exists' => 'Не хорошо лазить в коде)',
        ];
        $request->validate([
            "id" => 'required|exists:roles_admin,id',
        ], $messages);
        RoleAdmin::where('id', $request->id)->delete();
        return redirect()->route('admin.role.finish', ['type' => 'delete', 'id' => $request->id]);
    }

    public function finish($type, $id) {
        if ($type == "delete") {
            $role = (object) [
                'name' => $id
            ];
        }
        else {
            $role = RoleAdmin::find($id);
        }
        return view("admin.role.template.finish", [
            'meta_title' => 'Завершение действия с ролями',
            'role' => $role,
            "type" => $type
        ]);
    }
}