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
                                @if(isset($url))
                                    <h1>Изменение URL</h1>
                                @else
                                    <h1>Добавление URL</h1>
                                @endif
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.steps.urls.index') }}">URL Шагов</a></li>
                                        @if(isset($url))
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
                            <form action="{{ isset($url) ? route('admin.steps.urls.edit.confirm', ['id' => $url->id]) : route('admin.steps.urls.add.confirm') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($url))
                                    @method('PUT')
                                @endif
                                <table class="table">
                                    <input type="hidden" name="id" value="{{ $url->id ?? '' }}">
                                    <tr>
                                        <td>URL</td>
                                        <td>
                                            <input type="text" name="url" value="{{ old('url', $url->url ?? '') }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Этап</td>
                                        <td>
                                            <select name="step_id" class="form-control">
                                                @foreach($steps as $step)
                                                    <option value="{{ $step->id }}" {{ isset($url) && $url->step_id == $step->id ? 'selected' : '' }}>{{ $step->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary ms-auto me-auto">{{ isset($url) ? 'Изменить' : 'Добавить' }}</button>
                                            <a href="{{ route('admin.steps.urls.index') }}" class="btn btn-secondary ms-auto button-100px">Назад</a>
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
