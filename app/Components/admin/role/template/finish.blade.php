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
                                <h1>Операция закончена.</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Роли</a></li>
                                        <li class="breadcrumb-item active">Завершение</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <h2>Операция закончена.</h2>
                            </div>
                            <div class="row mb-2">
                                @switch($type)
                                    @case('edit')
                                        <p>Изменение роли {{ $role->name }} завершено</p>
                                        @break
                                    @case('add')
                                        <p>Добавление роли {{ $role->name }} завершено</p>
                                        @break
                                    @case('delete')
                                        <p>Удаление роли {{ $role->name }} завершено</p>
                                        @break
                                    $@default
                                        <p>Не читери)</p>
                                @endswitch
                            </div>
                            <div class="row">
                                <a href="{{ route('admin.role.index') }}" class="btn btn-primary ms-auto me-1">Хорошо!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection