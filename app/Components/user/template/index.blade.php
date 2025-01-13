<?php
use App\Components\admin\Auth;
?>

@extends('layouts.app')

@section('head_content')
    <title>{{ $meta_title }}</title>
@endsection

@section('header')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Логотип или название сайта -->
        <a class="navbar-brand" href="{{ url('/') }}">IT-ROADMAP</a>
        
        <!-- Кнопка для мобильных устройств -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключить навигацию">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Содержимое навигации -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if (\App\Models\User::isUser())
                    @php
                        $user = \App\Models\User::auth();
                    @endphp
                    @if($user)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Аватар пользователя -->
                                <img src="{{ isset($user->path_icon) ? asset('storage/' . $user->path_icon) : asset('images/default-avatar.png') }}" 
                                     alt="Аватар пользователя" 
                                     class="rounded-circle me-2" 
                                     width="30" 
                                     height="30">
                                <!-- Никнейм пользователя -->
                                <span>{{ $user->nickname }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('courses.index') }}">Курсы</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.courses.index') }}">Мои курсы</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('profile.achievements.index') }}">Достижения</a></li> --}}
                                <li><a class="dropdown-item" href="{{ route('profile.settings.index') }}">Настройки</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Выйти</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Если пользователь не найден в базе данных -->
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="{{ route('login.index') }}">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="{{ route('registration.index') }}">Регистрация</a>
                        </li>
                    @endif
                @else
                    <!-- Кнопка авторизации для гостей -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="{{ route('login.index') }}">Войти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="{{ route('registration.index') }}">Регистрация</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
    @yield('main_section')
@endsection