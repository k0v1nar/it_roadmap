@extends('admin.template.admin-template', ['page_name' => "steps"])

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Операция завершена</h1>
            <div class="card">
                <div class="card-body">
                    <p>Операция <b>{{ $type }}</b> для шага курса <b>{{ $step->name }}</b> была успешно выполнена.</p>
                    <a href="{{ route('admin.steps.index') }}" class="btn btn-secondary">Назад</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
