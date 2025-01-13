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
                                <h1>Список достижений пользователей</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item active">Полученные достижения</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <h2>Список достижений пользователей</h2>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <a href="{{ route('admin.user.achievement.add') }}" class="btn btn-primary ms-auto button-100px">Добавить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($userAchievements->isEmpty())
                                    <p>Полученные достижения не найдены.</p>
                                @else
                                    <table class="table">
                                        <tr>
                                            <th>Пользователь</th>
                                            <th>Достижение</th>
                                            <th>Дата получения</th>
                                            <th>Действия</th>
                                        </tr>
                                        @foreach($userAchievements as $userAchievement)
                                            <tr>
                                                <td>{{ $userAchievement->user->nickname }}</td>
                                                <td>{{ $userAchievement->achievement->name }}</td>
                                                <td>{{ $userAchievement->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.user.achievement.edit', ['id' => $userAchievement->id]) }}" class="btn btn-warning me-1">Редактировать</a> |
                                                    <a href="{{ route('admin.user.achievement.delete', ['id' => $userAchievement->id]) }}" class="btn btn-danger ms-1">Удалить</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div class="pagination">
                                        {{ $userAchievements->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
