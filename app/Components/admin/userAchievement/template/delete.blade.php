@extends('admin.template.admin-template', [
    'page_name' => "userachievements",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h1>Удаление достижения пользователя</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.user.achievement.index') }}">Достижения пользователей</a></li>
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
                            <form action="{{ route('admin.user.achievement.delete.confirm', ['id' => $userAchievement->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $userAchievement->id }}">
                                <table class="table">
                                    <tr>
                                        <td>Пользователь</td>
                                        <td>{{ $userAchievement->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Достижение</td>
                                        <td>{{ $userAchievement->achievement->title }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-danger ms-auto me-auto">Удалить</button>
                                            <a href="{{ route('admin.user.achievement.index') }}" class="btn btn-secondary ms-auto button-100px">Назад</a>
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
