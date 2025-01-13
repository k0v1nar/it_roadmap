<?php
use App\Components\admin\Auth;
?>

@extends('admin.template.admin-template', [
    'page_name' => "admins",
])

@push('style')
    <style>
        .table {
            width: 100%;
            table-layout: auto;
        }
        
        .table th:nth-child(2),
        .table td:nth-child(2),
        .table th:nth-child(3),
        .table td:nth-child(3),
        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 100%; /* Первые два столбца равны и занимают оставшееся пространство */
        }

        .table th:nth-child(1),
        .table td:nth-child(1),
        .table th:nth-child(5),
        .table td:nth-child(5),
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
                                <h1>Сотрудники</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item active">Сотрудники</li>
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
                                    <h2>Сотрудники</h2>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <a href="{{ route('admin.admin.add') }}" class="btn btn-primary ms-auto button-100px">Добавить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($admins->isEmpty())
                                    <p>Сотрудники не найдены.</p>
                                @else
                                    <table class="table table-response table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Никнейм</th>
                                                <th>Логин</th>
                                                <th>Роль</th>
                                                <th>Иконка</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($admins as $admin)
                                                <tr>
                                                    <td>{{ $admin->id }}</td>
                                                    <td>{{ $admin->nickname }}</td>
                                                    <td>{{ $admin->login }}</td>
                                                    <td>{{ $admin->role->name }}</td>
                                                    <td>@if (isset($admin->path_icon))
                                                         <img src="{{ asset('storage/' . $admin->path_icon) }}" alt="Иконка" width="100" height="100">
                                                         @else
                                                         Нет
                                                         @endif 
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a class="btn btn-warning me-1" href="{{ route('admin.admin.edit', ['id'=>$admin->id]) }}">
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                            @if ($admin->id != 1) 
                                                                <a class="btn btn-danger ms-1" href="{{ route('admin.admin.delete', ['id'=>$admin->id]) }}">
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
                                        {{ $admins->links() }}
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