<?php
use App\Components\admin\Auth;
?>

@extends('admin.template.admin-template', [
    'page_name' => "steps",
])

@push('style')
    <style>
        .table {
            width: 100%;
            table-layout: auto;
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
                                <h1>Этапы</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item active">Этапы</li>
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
                                    <h2>Этапы</h2>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <a href="{{ route('admin.steps.add') }}" class="btn btn-primary ms-auto button-100px">Добавить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($steps->isEmpty())
                                    <p>Этапы не найдены.</p>
                                @else
                                    <table class="table table-response table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Имя</th>
                                                <th>Описание</th>
                                                <th>Среднее время прохождения</th>
                                                <th>Предыдущий шаг</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($steps as $step)
                                                <tr>
                                                    <td>{{ $step->id }}</td>
                                                    <td>{{ $step->name }}</td>
                                                    <td>{{ $step->description }}</td>
                                                    <td>{{ $step->average_completion_time }}</td>
                                                    <td>{{ isset($step->previous_id) ? $step->previous_id : 'Первый шаг' }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a class="btn btn-secondary me-1" href="{{ route('admin.steps.edit', ['id'=>$step->id]) }}">
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                            <a class="btn btn-danger ms-1" href="{{ route('admin.steps.delete', ['id'=>$step->id]) }}">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $steps->links() }}
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