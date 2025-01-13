@extends('user.template.index')

@section('content')
<form method="POST" action="{{ route('registration') }}" enctype="multipart/form-data" class="block">
    @csrf
    <!-- Никнейм -->
    <div class="mb-3">
        <label for="login" class="form-label">Логин</label>
        <input 
            type="text" 
            id="login" 
            name="login" 
            class="form-control @error('login') is-invalid @enderror" 
            value="{{ old('login') }}" 
            required 
        />
        @error('login')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Никнейм -->
    <div class="mb-3">
        <label for="nickname" class="form-label">Никнейм</label>
        <input 
            type="text" 
            id="nickname" 
            name="nickname" 
            class="form-control @error('nickname') is-invalid @enderror" 
            value="{{ old('nickname') }}" 
            required 
        />
        @error('nickname')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Иконка -->
    <div class="mb-3">
        <label for="icon" class="form-label">Иконка</label>
        <div class="d-flex align-items-center">
            <input 
                type="file" 
                id="icon" 
                name="icon" 
                class="form-control @error('icon') is-invalid @enderror" 
                accept="image/*" 
            />
        </div>
        @error('icon')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Пароль -->
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            class="form-control @error('password') is-invalid @enderror" 
            required 
        />
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Подтверждение пароля -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
        <input 
            type="password" 
            id="password_confirmation" 
            name="password_confirmation" 
            class="form-control @error('password_confirmation') is-invalid @enderror" 
            required 
        />
        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary me-1 w-100">Зарегистрироваться</button>
        </div>
        <div class="col">
            <a class="btn btn-secondary ms-1 w-100" href="{{ route('login') }}">Уже есть аккаунт? Войти</a>
        </div>
        <div class="col">
            <a class="btn btn-secondary ms-1 w-100" href="{{ route('main') }}">Назад</a>
        </div>
    </div>
</form>
@endsection
