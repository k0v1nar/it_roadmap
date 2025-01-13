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
                                <h1>{{ isset($userAchievement) ? 'Изменение' : 'Добавление' }} достижения пользователя</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.user.achievement.index') }}">Достижения пользователей</a></li>
                                        @if(isset($userAchievement))
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
                            <form action="{{ isset($userAchievement) ? route('admin.user.achievement.edit.confirm', ['id' => $userAchievement->id]) : route('admin.user.achievement.add.confirm') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($userAchievement))
                                    @method('PUT')
                                @endif
                                <input type="hidden" name="id" value="{{ $userAchievement->id ?? '' }}">
                                <table class="table">
                                    <tr>
                                        <td>Пользователь</td>
                                        <td>
                                            <select name="user_id" class="form-control">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ (old('user_id', $userAchievement->user_id ?? '') == $user->id) ? 'selected' : '' }}>{{ $user->nickname }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Достижение</td>
                                        <td>
                                            <select name="achievement_id" class="form-control">
                                                @foreach($achievements as $achievement)
                                                    <option value="{{ $achievement->id }}" {{ (old('achievement_id', $userAchievement->achievement_id ?? '') == $achievement->id) ? 'selected' : '' }}>{{ $achievement->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary ms-auto me-auto">{{ isset($userAchievement) ? 'Изменить' : 'Добавить' }}</button>
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
