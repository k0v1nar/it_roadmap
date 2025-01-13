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
                                <h1>{{ isset($achievement) ? 'Изменение' : 'Добавление' }} достижения</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.achievement.index') }}">Достижения</a></li>
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
                            <form action="{{ isset($achievement) ? route('admin.achievement.edit.confirm', ['id' => $achievement->id]) : route('admin.achievement.add.confirm') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($achievement))
                                    @method('PUT')
                                @endif
                                <input type="hidden" name="id" value="{{ $achievement->id ?? '' }}">
                                <table class="table">
                                    <tr>
                                        <td>Название</td>
                                        <td>
                                            <input type="text" name="name" value="{{ old('name', $achievement->name ?? '') }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Описание</td>
                                        <td>
                                            <textarea name="description" class="form-control">{{ old('description', $achievement->description ?? '') }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Иконка:</td>
                                        <td>
                                            <input type="file" name="path_icon" value="{{ old('path_icon', $achievement->path_icon ?? '') }}" class="form-control">
                                            @if(isset($achievement) && $achievement->path_icon)
                                                <br>
                                                <img src="{{ asset('storage/' . $achievement->path_icon) }}" alt="Иконка" width="100" height="100">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary ms-auto me-auto">{{ isset($achievement) ? 'Изменить' : 'Добавить' }}</button>
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