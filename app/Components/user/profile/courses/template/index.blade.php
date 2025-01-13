@extends('user.template.index')

@section('content')
    <div class="block">
        <h1 class="mt-4">Мои курсы</h1>
        <div class="row">
            @foreach ($selectedCourses as $selected)
                <div class="col-12">
                    <div class="card flex-row mb-4">
                        @if ($selected->curs->path_icon)
                            <img src="{{ asset('storage/' . $selected->curs->path_icon) }}" class="card-img-left my-auto ms-2" alt="{{ $selected->curs->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $selected->curs->name }}</h5>
                            <p class="card-text">{{ $selected->curs->description }}</p>
                            <p class="text-muted">Цель: {{ $selected->curs->purpose }}</p>
                            <p class="text-muted">
                                Прогресс: {{ $selected->progress }}%
                                @if ($selected->is_finish)
                                    <br>Завершено: {{ $selected->date_of_finish }}
                                @endif
                            </p>
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('profile.courses.course.index', ['course' => $selected->curs->id]) }}" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $selectedCourses->links() }}
            </div>
        </div>
    </div>
@endsection
