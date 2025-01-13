@extends('admin.template.admin-template', [
    'page_name' => "users",
])

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-6">
                            @if(isset($user))
                                <h1>Изменение пользователя</h1>
                            @else
                                <h1>Добавление пользователя</h1>
                            @endif
                        </div>
                        <div class="col-6">
                            <nav class="float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Пользователи</a></li>
                                    @if(isset($user))
                                        <li class="breadcrumb-item active">Изменение</li>
                                    @else
                                        <li class="breadcrumb-item active">Добавление</li>
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ isset($user) ? route('admin.user.edit.confirm', ['id' => $user->id]) : route('admin.user.add.confirm') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
                            <table class="table">
                                <tr>
                                    <td>Никнейм</td>
                                    <td>
                                        <input type="text" name="nickname" value="{{ old('nickname', $user->nickname ?? '') }}" class="form-control">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Логин</td>
                                    <td>
                                        <input type="text" name="login" value="{{ old('login', $user->login ?? '') }}" class="form-control">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Пароль</td>
                                    <td>
                                        <input type="password" name="password" class="form-control">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Иконка:</td>
                                    <td>
                                        <input type="file" name="path_icon" value="{{ old('path_icon', $user->path_icon ?? '') }}" class="form-control">
                                        @if(isset($user) && $user->path_icon)
                                            <br>
                                            <img src="{{ asset('storage/' . $user->path_icon) }}" alt="Иконка" width="100" height="100">
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-primary ms-auto me-auto">{{ isset($user) ? 'Изменить' : 'Добавить' }}</button>
                                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary ms-auto button-100px">Назад</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
