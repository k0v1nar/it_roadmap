@extends('admin.template.admin-template', [
    'page_name' => "achievements",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Операция закончена.</h1>
                <div class="card">
                    <div class="card-body">
                        <h2>Операция завершена.</h2>
                        @switch($type)
                            @case('edit')
                                <p>Изменение достижения {{ $achievement->name }} завершено</p>
                                @break
                            @case('add')
                                <p>Добавление достижения {{ $achievement->name }} завершено</p>
                                @break
                            @case('delete')
                                <p>Удаление достижения {{ $achievement->name }} завершено</p>
                                @break
                            @default
                                <p>Не читери)</p>
                        @endswitch
                        <a href="{{ route('admin.achievement.index') }}" class="btn btn-primary ms-auto me-1">Хорошо!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection