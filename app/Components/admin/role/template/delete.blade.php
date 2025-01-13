<?php
use App\Components\admin\Auth;
?>

@extends('admin.template.admin-template', [
    'page_name' => "roles",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h1>Удаление роли</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Роли</a></li>
                                        <li class="breadcrumb-item active">Удаление</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <form ENCTYPE="multipart/form-data" action="{{ route('admin.role.delete.confirm', ['id' => $role->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <table class="table">
                                    <input type="hidden" name="id" value="{{ $role->id ?? '' }}">
                                    <tr>
                                        <td>Название:</td>
                                        <td>{{ $role->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Количество затронутых пользователей:</td>
                                        <td>{{ $countAdmins }}</td>
                                    </tr>
                                    <tr>
                                        <td>Предупреждение:</td>
                                        <td>Их аккаунты будут заблокированны до переназначения роли</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary ms-auto me-auto">Удалить</button>
                                            <a href="{{ route('admin.role.index') }}" class="btn btn-secondary ms-auto button-100px">Назад</a>
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