<?php

namespace App\Components\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        if (User::isUser()) {
            return redirect()->route('main');
        }
        return view('user.auth.template.index', [
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
        $user = User::where('login', $login)->first();
        if (isset($user)) {
            if (Hash::check($password, $user->password)) {
                $user->makeAuth();
                return redirect()->route('main');
            }
        }
        return back()->withErrors(['error'=>'Неверный логин или пароль!']);
    }

    public function logout(Request $request) {
        $user = User::auth();
        if (isset($user)) {
            $user->logout();
            return redirect()->route('main');
        }
        return redirect()->route('main');
    }
}