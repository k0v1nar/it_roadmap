@extends('admin.template.admin-template', ['page_name' => "steps"])

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-6">
                    <h1>{{ isset($step) ? 'Изменение шага' : 'Добавление шага' }}</h1>
                </div>
                <div class="col-6">
                    <nav class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.steps.index') }}">Этапы</a></li>
                            <li class="breadcrumb-item active">{{ isset($step) ? 'Изменение' : 'Добавление' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" 
                          action="{{ isset($step) ? route('admin.steps.edit.confirm', ['id' => $step->id]) : route('admin.steps.add.confirm') }}" 
                          method="post" >
                        @csrf
                        @if(isset($step))
                            @method('PUT')
                        @endif

                        <table class="table" style="margin-bottom: 0px">
                            {{-- <tr>
                                <td>Курс:</td>
                                <td>
                                    <select v-model="selectedCourse" class="form-select" name="curs_id" required>
                                        <option value="">Выберите курс</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ isset($step) && $step->curs_id == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr> --}}
                            <tr>
                                <td>Название:</td>
                                <td>
                                    <input type="text" name="name" class="form-control" 
                                           value="{{ old('name', $step->name ?? '') }}" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Описание:</td>
                                <td>
                                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $step->description ?? '') }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Среднее время выполнения (в часах):</td>
                                <td>
                                    <input type="number" name="average_completion_time" class="form-control" 
                                           value="{{ old('average_completion_time', $step->average_completion_time ?? '') }}" min="0">
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>Предыдущий шаг:</td>
                                <td>
                                    <previous-step-selector
                                        :curs-id="selectedCourse"
                                        :current-step-id="{{ $step->id ?? 'null' }}"
                                        :initial-step-id="{{ $step->previous_id ?? 'null' }}">
                                    </previous-step-selector>
                                    <select name="previous_id" class="form-select">
                                        <option value="">Нет</option>
                                        @foreach($steps as $prevStep)
                                            <option value="{{ $prevStep->id }}" 
                                                {{ (isset($step) && $step->previous_id == $prevStep->id) ? 'selected' : '' }}>
                                                {{ $prevStep->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr> --}}
                        </table>

                        <step-selector
                        :available-courses="{{ json_encode($courses) }}"
                        :curs-id="{{ $step->curs_id ?? 'null' }}"
                        :current-step-id="{{ $step->id ?? 'null' }}"
                        :initial-step-id="{{ $step->previous_id ?? 'null' }}">
                    </step-selector>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($step) ? 'Изменить' : 'Добавить' }}
                            </button>
                            <a href="{{ route('admin.steps.index') }}" class="btn btn-secondary">Назад</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
