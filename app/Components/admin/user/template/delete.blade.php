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
                                <h1>Удаление пользователя</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Пользователи</a></li>
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
                            <form action="{{ route('admin.user.delete.confirm', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <div class="mb-3">
                                    <label for="nickname" class="form-label">Никнейм</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $user->nickname }}" disabled class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="login" class="form-label">Логин</label>
                                    <input type="text" class="form-control" id="login" name="login" value="{{ $user->login }}" disabled class="form-control">
                                </div>
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
