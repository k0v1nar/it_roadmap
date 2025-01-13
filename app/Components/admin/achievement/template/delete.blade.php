@extends('admin.template.admin-template', [
    'page_name' => "achievements",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h1>Удаление достижения</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.achievement.index') }}">Достижения</a></li>
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
                            <form action="{{ route('admin.achievement.delete.confirm', ['id' => $achievement->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <table class="table">
                                    <tr>
                                        <td>Название:</td>
                                        <td>{{ $achievement->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Описание:</td>
                                        <td>{{ $achievement->description }}</td>
                                    </tr>
                                    <tr>
                                        <td>Иконка:</td>
                                        <td>
                                            @if(isset($achievement) && $achievement->path_icon)
                                                <br>
                                                <img src="{{ asset('storage/' . $achievement->path_icon) }}" alt="Иконка" width="100" height="100">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary ms-auto me-auto">Удалить</button>
                                            <a href="{{ route('admin.achievement.index') }}" class="btn btn-secondary ms-auto button-100px">Назад</a>
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