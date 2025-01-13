@extends('user.template.index')

@section('content')
    <div class="block">
        <h1 class="mt-4">Список курсов</h1>
        <div class="row">
            @foreach ($courses as $cours)
                <div class="col-12">
                    <div class="card flex-row mb-4">
                        @if ($cours->path_icon)
                            <img src="{{ asset('storage/' .$cours->path_icon) }}" class="card-img-left my-auto ms-2" alt="{{ $cours->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $cours->name }}</h5>
                            <p class="card-text">{{ $cours->description }}</p>
                            <p class="text-muted">Цель: {{ $cours->purpose }}</p>
                            @if ($cours->first_step)
                                <p class="text-muted">Первый шаг: {{ $cours->first_step->name }}</p>
                            @endif
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('courses.course.index', ['course' => $cours->id]) }}" class="btn btn-primary">Подробнее</a>
                                </div>
                                @if (isset($user) && !$cours->selected)
                                    <div class="col">
                                        <form action="{{ route('profile.courses.course.add', ['course' => $cours->id]) }}" method="POST" enctype="multipart/form-data"> 
                                            @csrf
                                            <button type="submit" role="button" class="ms-auto btn btn-primary">Записаться</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
@endsection