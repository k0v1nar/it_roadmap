<?php
    use Illuminate\Support\Str;
?>

@extends('admin.template.admin-template', [
    'page_name' => "stepUrls",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h1>Список URL Шагов</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                                        <li class="breadcrumb-item active">URL Шагов</li>
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
                                    <h2>Список URL Шагов</h2>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <a href="{{ route('admin.steps.urls.add') }}" class="btn btn-primary ms-auto mb-3 button-100px">Добавить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($urls->isEmpty())
                                    <p>Ссылки не найдены.</p>
                                @else
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Этап</th>
                                                <th>URL</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($urls as $url)
                                                <tr>
                                                    <td>{{ $url->step->name }}</td>
                                                    <td>{{ Str::limit($url->url, 100) }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.steps.urls.edit', ['id' => $url->id]) }}" class="btn btn-warning btn-sm">Изменить</a>
                                                        <a href="{{ route('admin.steps.urls.delete', ['id' => $url->id]) }}" class="btn btn-danger btn-sm">Удалить</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Pagination -->
                                    <div class="d-flex justify-content-center">
                                        {{ $urls->links() }}
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
