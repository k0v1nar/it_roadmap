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
    </div>
</nav>
@endsection

@section('content')
    <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="p-2">
            Авторизация:
        </div>
        <div class="p-2">
            <input type="text" id="login" name="login" placeholder="Логин" class="form-control">
        </div>
        <div class="p-2">
            <input type="password" id="password" name="password" placeholder="Пароль" class="form-control">
        </div>
        <div class="p-2">
            <button type="submit" class="btn btn-primary w-100">Войти</button>
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
        </div>
    @endif
@endsection