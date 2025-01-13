<?php
use App\Components\admin\Auth;
?>

@extends('admin.template.admin-template', [
    'page_name' => "roles",
])

@push('style')
    <style>
        .table {
            width: 100%;
            table-layout: auto;
        }
        
        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 100%; /* Первые два столбца равны и занимают оставшееся пространство */
        }

        .table th:nth-child(1),
        .table td:nth-child(1),
        .table th:last-child,
        .table td:last-child {
            width: auto;
            white-space: nowrap; /* Минимизирует ширину третьего столбца по содержимому */
        }
    </style>
@endpush

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h1>Роли</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item active">Роли</li>
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
                                <div class="col">
                                    <h2>Роли сотрудников</h2>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <a href="{{ route('admin.role.add') }}" class="btn btn-primary ms-auto button-100px">Добавить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($roles->isEmpty())
                                    <p>Роли не найдены.</p>
                                @else
                                    <table class="table table-response table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $role)
                                                <tr>
                                                    <td>{{ $role->id }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a class="btn btn-secondary me-1" href="{{ route('admin.role.edit', ['id'=>$role->id]) }}">
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                            @if ($role->id != 1) 
                                                                <a class="btn btn-danger ms-1" href="{{ route('admin.role.delete', ['id'=>$role->id]) }}">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $roles->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection