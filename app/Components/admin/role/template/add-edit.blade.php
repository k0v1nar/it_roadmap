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
                                @if(isset($role))
                                    <h1>Изменение роли</h1>
                                @else
                                    <h1>Добавление роли</h1>
                                @endif
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Роли</a></li>
                                        @if(isset($role))
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
                            <form ENCTYPE="multipart/form-data" action="{{ isset($role) ? route('admin.role.edit.confirm', ['id' => $role->id]) : route('admin.role.add.confirm') }}" method="post">
                                @csrf
                                @if(isset($role))
                                    @method('PUT')
                                @endif
                                <table class="table">
                                    <input type="hidden" name="id" value="{{ $role->id ?? '' }}">
                                    <tr>
                                        <td>Название</td>
                                        <td>
                                            <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary ms-auto me-auto">{{ isset($role) ? 'Изменить' : 'Добавить' }}</button>
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