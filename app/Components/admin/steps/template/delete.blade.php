@extends('admin.template.admin-template', ['page_name' => "steps"])

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-6">
                    <h1>Удаление шага курса</h1>
                </div>
                <div class="col-6">
                    <nav class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.steps.index') }}">Этапы курса</a></li>
                            <li class="breadcrumb-item active">Удаление</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.steps.destroy', ['id' => $step->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <p>Вы уверены, что хотите удалить шаг курса <b>{{ $step->name }}</b>?</p>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-danger">Удалить</button>
                            <a href="{{ route('admin.steps.index') }}" class="btn btn-secondary">Назад</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
