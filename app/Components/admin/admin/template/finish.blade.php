@extends('admin.template.admin-template', ['page_name' => "admins"])

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Операция завершена</h1>
            <div class="card">
                <div class="card-body">
                    <p>Операция <b>{{ $type }}</b> для администратора <b>{{ $admin->nickname }}</b> была успешно выполнена.</p>
                    <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary">Назад</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
