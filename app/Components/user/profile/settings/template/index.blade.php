@extends('user.template.index')

@section('content')
<form method="POST" action="{{ route('profile.settings.update') }}" enctype="multipart/form-data" class="block">
    @csrf
    @method('PUT')

    <!-- Никнейм -->
    <div class="mb-3">
        <label for="nickname" class="form-label">Никнейм</label>
        <input 
            type="text" 
            id="nickname" 
            name="nickname" 
            class="form-control @error('nickname') is-invalid @enderror" 
            value="{{ old('nickname', $user->nickname) }}" 
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
            <!-- Текущая иконка -->
            <img 
                src="{{ asset('storage/' . $user->path_icon) }}" 
                alt="Текущая иконка" 
                class="rounded-circle me-3" 
                style="width: 50px; height: 50px;"
            />
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

    <!-- Текущий пароль -->
    <div class="mb-3">
        <label for="current_password" class="form-label">Текущий пароль</label>
        <input 
            type="password" 
            id="current_password" 
            name="current_password" 
            class="form-control @error('current_password') is-invalid @enderror"  
        />
        @error('current_password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Новый пароль -->
    <div class="mb-3">
        <label for="new_password" class="form-label">Новый пароль</label>
        <input 
            type="password" 
            id="new_password" 
            name="new_password" 
            class="form-control @error('new_password') is-invalid @enderror" 
        />
        @error('new_password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Подтверждение нового пароля -->
    <div class="mb-3">
        <label for="new_password_confirmation" class="form-label">Подтвердите новый пароль</label>
        <input 
            type="password" 
            id="new_password_confirmation" 
            name="new_password_confirmation" 
            class="form-control @error('new_password_confirmation') is-invalid @enderror" 
        />
        @error('new_password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary me-1 w-100">Сохранить</button>
        </div>
        <div class="col">
            <a class="btn btn-secondary ms-1 w-100" href="{{ route('main') }}">Назад</a>
        </div>
    </div>
    <!-- Кнопка сохранения -->
</form>
@endsection
