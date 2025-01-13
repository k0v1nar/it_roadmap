@extends('user.template.index')

@section('content')
<div class="container">
    <div class="col-12">
        <div class="block">
            <h3>Топ 5 популярных курсов</h3>
            <div class="row">
                @php
                    $number = 1;
                @endphp
                @foreach($popularCurs as $curs)
                    <div class="card flex-row">
                        <img src="{{  asset('storage/' . $curs->path_icon) }}" class="card-img-left" alt="{{ $curs->name }}">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title">{{ $number }}. <a href="{{ route('courses.course.index', ['course' => $curs->id]) }}">{{ $curs->name }}</a></h5>
                            <p class="card-text">Количество выборов: {{ $curs->selected_count }}</p>
                        </div>
                    </div>
                    @php
                        $number = $number + 1;
                    @endphp
                @endforeach
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-primary mt-3">Все курсы</a>
        </div>
    </div>
    <div class="col-12">
        <div class="block">
            <h3>Топ 5 завершенных курсов</h3>
            <div class="row">
                @php
                    $number = 1;
                @endphp
                @foreach($completedCurs as $curs)
                    <div class="card flex-row">
                        <img src="{{  asset('storage/' . $curs->path_icon) }}" class="card-img-left" alt="{{ $curs->name }}">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title">{{ $number }}. <a href="{{ route('courses.course.index', ['course' => $curs->id]) }}">{{ $curs->name }}</a></h5>
                            <p class="card-text">Процент завершения: {{ number_format($curs->completion_rate * 100, 2) }}%</p>
                        </div>
                    </div>
                    @php
                        $number = $number + 1;
                    @endphp
                @endforeach
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-primary mt-3">Все курсы</a>
        </div>
    </div>
    @if(count($activeCurs) > 0)
        <div class="col-12">
            <div class="block mt-4">
                <h3>Ваши активные курсы</h3>
                <div class="row">
                    @php
                        $number = 1;
                    @endphp
                    @foreach($activeCurs as $curs)
                        <div class="card flex-row">
                            <img src="{{ asset('storage/' . $curs->curs->path_icon) }}" class="card-img-left" alt="{{ $curs->curs->name }}">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h5 class="card-title">{{ $number }}. <a href="{{ route('profile.courses.course.index', ['course' => $curs->curs_id]) }}">{{ $curs->curs->name }}</a></h5>
                                <p class="card-text">Последнее обновление: {{ $curs->updated_at->format('d.m.Y H:i') }}</p>
                            </div>
                        </div>
                        @php
                            $number = $number + 1;
                        @endphp
                    @endforeach
                </div>
                <a href="{{ route('profile.courses.index') }}" class="btn btn-primary mt-3">Мои курсы</a>
            </div>
        </div>
    @endif
</div>
@endsection