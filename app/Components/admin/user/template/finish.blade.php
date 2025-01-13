@extends('admin.template.admin-template', [
    'page_name' => "users",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h1>Операция завершена</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Пользователи</a></li>
                                        <li class="breadcrumb-item active">Завершено</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                Операция <strong>{{ $type === 'add' ? 'добавления' : ($type === 'edit' ? 'изменения' : 'удаления') }}</strong> пользователя с
                                никнеймом {{ $user->nickname }} была успешно завершена.
                            </p>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-primary">Перейти к списку пользователей</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
