@extends('admin.template.admin-template', ['page_name' => "admins"])

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h1>Удаление администратора</h1>
                        </div>
                        <div class="col-6">
                            <nav class="float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">Администраторы</a></li>
                                    <li class="breadcrumb-item active">Удаление</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.admin.delete.confirm') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $admin->id }}">
                            <p>Вы уверены, что хотите удалить администратора <b>{{ $admin->nickname }}</b>?</p>
                            <div class="text-center row">
                                <button type="submit" class="btn btn-danger">Удалить</button>
                                <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary ms-auto button-100px">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
