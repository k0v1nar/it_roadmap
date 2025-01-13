<?php
    use Carbon\Carbon;
?>
@extends('layouts.app')
@section('content')
    <form action="/admin/login" method="POST" enctype="multipart/form-data">
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
