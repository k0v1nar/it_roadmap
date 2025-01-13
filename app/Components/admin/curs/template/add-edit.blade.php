@extends('admin.template.admin-template', [
    'page_name' => "courses",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h1>{{ isset($curs) ? 'Изменение' : 'Добавление' }} курса</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.curs.index') }}">Курсы</a></li>
                                        @if(isset($curs))
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
                            <form action="{{ isset($curs) ? route('admin.curs.edit.confirm', ['id' => $curs->id]) : route('admin.curs.add.confirm') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($curs))
                                    @method('PUT')
                                @endif
                                <input type="hidden" name="id" value="{{ $curs->id ?? '' }}">
                                <table class="table">
                                    <tr>
                                        <td>Название</td>
                                        <td>
                                            <input type="text" name="name" value="{{ old('name', $curs->name ?? '') }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Описание</td>
                                        <td>
                                            <textarea name="description" class="form-control">{{ old('description', $curs->description ?? '') }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Цель курса</td>
                                        <td>
                                            <input type="text" name="purpose" value="{{ old('purpose', $curs->purpose ?? '') }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Среднее время прохождения</td>
                                        <td>
                                            <input type="text" name="average_completion_time" value="{{ old('average_completion_time', $curs->average_completion_time ?? '') }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Шаг 1 (Первый шаг курса)</td>
                                        <td>
                                            <select name="first_step_id" class="form-control">
                                                @foreach($steps as $step)
                                                    <option value="{{ $step->id }}" {{ old('first_step_id', $curs->first_step_id ?? '') == $step->id ? 'selected' : '' }}>
                                                        {{ $step->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Иконка:</td>
                                        <td>
                                            <input type="file" name="path_icon" class="form-control">
                                            @if(isset($curs) && $curs->path_icon)
                                                <br>
                                                <img src="{{ asset('storage/' . $curs->path_icon) }}" alt="Иконка" width="100" height="100">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary ms-auto me-auto">{{ isset($curs) ? 'Изменить' : 'Добавить' }}</button>
                                            <a href="{{ route('admin.curs.index') }}" class="btn btn-secondary ms-auto button-100px">Назад</a>
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
