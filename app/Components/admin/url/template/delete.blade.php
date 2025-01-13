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
                                <h1>Удаление URL</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.steps.urls.index') }}">URL Шагов</a></li>
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
                            <form action="{{ route('admin.steps.urls.delete.confirm', ['id' => $url->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <table class="table">
                                    <input type="hidden" name="id" value="{{ $url->id }}">
                                    <tr>
                                        <td>URL</td>
                                        <td>{{ $url->url }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary ms-auto me-auto">Удалить</button>
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
