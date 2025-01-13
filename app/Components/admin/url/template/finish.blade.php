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
                                <h1>Действие с URL завершено</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.steps.urls.index') }}">URL Шагов</a></li>
                                        <li class="breadcrumb-item active">Завершение</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success">
                                <h5>Действие с URL завершено успешно.</h5>
                                <p>
                                    @if($type == 'add')
                                        Вы добавили новый URL: {{ $url->url }}.
                                    @elseif($type == 'edit')
                                        Вы изменили URL: {{ $url->url }}.
                                    @elseif($type == 'delete')
                                        Вы удалили URL: {{ $url->url }}.
                                    @endif
                                </p>
                            </div>
                            <a href="{{ route('admin.steps.urls.index') }}" class="btn btn-primary">Вернуться к списку</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
