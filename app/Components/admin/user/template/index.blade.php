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
                                <h1>Список пользователей</h1>
                            </div>
                            <div class="col-6">
                                <nav class="float-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                        <li class="breadcrumb-item active">Пользователи</li>
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
                                    <h2>Список пользователей</h2>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <a href="{{ route('admin.user.add') }}" class="btn btn-primary ms-auto button-100px">Добавить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($users->isEmpty())
                                    <p>Пользователи не найдены.</p>
                                @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Никнейм</th>
                                                <th>Логин</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->nickname }}</td>
                                                    <td>{{ $user->login }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-warning">Изменить</a>
                                                        <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}" class="btn btn-danger">Удалить</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="pagination">
                                        {{ $users->links() }}
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
