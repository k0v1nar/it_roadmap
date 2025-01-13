@extends('user.template.index')

@section('content')
    <div class="col">
        <div class="block">
            <h1 class="mt-4">{{ $curs->name }}</h1>
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Описание:</strong> {{ $curs->description }}</li>
                <li class="list-group-item"><strong>Цель:</strong> {{ $curs->purpose }}</li>
                <li class="list-group-item"><strong>Среднее время завершения:</strong> {{ $curs->average_completion_time }} часов</li>
                <li class="list-group-item"><strong>Иконка:</strong> 
                    @if ($curs->path_icon)
                        <img src="{{ asset('storage/'.$curs->path_icon) }}" alt="Иконка {{ $curs->name }}" class="img-thumbnail" style="max-height: 100px;">
                    @else
                        <span>Не указана</span>
                    @endif
                </li>
                @if (isset($user))
                    <li class="list-group-item">
                        <form action="{{ route('profile.courses.course.add', ['course' => $curs->id]) }}" method="POST" enctype="multipart/form-data"> 
                            @csrf
                            <button type="submit" role="button" class="btn btn-primary">Записаться</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
        <course-graph :steps="{{ $steps }}"></course-graph>
    </div>
@endsection