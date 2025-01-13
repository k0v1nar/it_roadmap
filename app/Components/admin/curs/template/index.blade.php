@extends('admin.template.admin-template', [
    'page_name' => "curs",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h1>Курсы</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item active">Курсы</li>
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
                                    <h2>Курсы</h2>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <a href="{{ route('admin.curs.add') }}" class="btn btn-primary ms-auto mb-3 button-100px">Добавить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($curs->isEmpty())
                                    <p>Курсы не найдены.</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Название</th>
                                                <th>Описание</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($curs as $course)
                                                <tr>
                                                    <td>{{ $course->id }}</td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->description }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.curs.edit', ['id' => $course->id]) }}" class="btn btn-warning">Изменить</a>
                                                        <a href="{{ route('admin.curs.delete', ['id' => $course->id]) }}" class="btn btn-danger">Удалить</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $curs->links() }}
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
