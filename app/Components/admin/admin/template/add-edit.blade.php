@extends('admin.template.admin-template', ['page_name' => "admins"])

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-6">
                            @if(isset($admin))
                                <h1>Изменение администратора</h1>
                            @else
                                <h1>Добавление администратора</h1>
                            @endif
                        </div>
                        <div class="col-6">
                            <nav class="float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">Администраторы</a></li>
                                    @if(isset($admin))
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
                        <form ENCTYPE="multipart/form-data" action="{{ isset($admin) ? route('admin.admin.edit.confirm', ['id' => $admin->id]) : route('admin.admin.add.confirm') }}" method="post">
                            @if(isset($admin))
                                @method('PUT')
                            @endif
                            @csrf
                            <table class="table">
                                <input type="hidden" name="id" value="{{ $admin->id ?? '' }}" class="form-control">
                                <tr>
                                    <td>Никнейм</td>
                                    <td>
                                        <input type="text" name="nickname" value="{{ old('nickname', $admin->nickname ?? '') }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Логин</td>
                                    <td>
                                        <input type="text" name="login" value="{{ old('login', $admin->login ?? '') }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Пароль</td>
                                    <td>
                                        <input type="password" name="password" value="" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Роль</td>
                                    <td>
                                        <select name="role_id" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ (isset($admin) && $admin->role_id == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Иконка:</td>
                                    <td>
                                        <input type="file" name="path_icon" value="{{ old('path_icon', $admin->path_icon ?? '') }}" class="form-control">
                                        @if(isset($admin) && $admin->path_icon)
                                            <br>
                                            <img src="{{ asset('storage/' . $admin->path_icon) }}" alt="Иконка" width="100" height="100">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-primary ms-auto me-auto">{{ isset($admin) ? 'Изменить' : 'Добавить' }}</button>  
                                        <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary ms-auto button-100px">Назад</a>
                                    </td>
                                </tr>
                                @if ($errors->any())
                                    <tr>
                                        <td>Ошибки:</td>
                                        <td>
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
