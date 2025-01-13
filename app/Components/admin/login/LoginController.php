<?php

namespace App\Components\admin\login;

use App\Http\Controllers\Controller;
use App\Components\admin\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route('admin.index');
        }
        return view('admin.login.template.index', [
            'meta_title' => 'Авторизация'
        ]);
    }

    public function login(Request $request) {
        $messages = [
            'login.required' => 'Введите логин.',
            'password.required' => 'Введите пароль.',
        ];
        $request->validate([
            "login" => "required",
            "password" => "required",
        ], $messages);
        $login = $request->login;
        $password = $request->password;
        $employee = Admin::where('login', $login)->first();
        if (isset($employee)) {
            if (Hash::check($password, $employee->password)) {
                Auth::login($employee);
                return redirect()->route('admin.index');
            }
        }
        return back()->withErrors(['error'=>'Неверный логин или пароль!']);
    }

    public function logout(Request $request) {
        Auth::check();
        Auth::logout();
        return redirect('/');
    }
}