@extends('admin.template.admin-template', [
    'page_name' => "userachievements",
])

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Операция завершена</h1>
                <p>
                    @switch($type)
                        @case('add')
                            Добавление достижения пользователя завершено
                            @break
                        @case('edit')
                            Изменение достижения пользователя завершено
                            @break
                        @case('delete')
                            Удаление достижения пользователя завершено
                            @break
                        @default
                            Неизвестный тип операции
                    @endswitch
                </p>
                <a href="{{ route('admin.user.achievement.index') }}" class="btn btn-secondary ms-auto me-auto">Назад</a>
            </div>
        </div>
    </div>
@endsection
