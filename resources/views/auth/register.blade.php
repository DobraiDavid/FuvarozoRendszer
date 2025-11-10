@extends('layouts.app')

@section('title', 'Regisztráció')

@section('content')
<div class="card" style="max-width: 400px; margin: 3rem auto;">
    <h2 style="margin-bottom: 1.5rem;">Fuvarozó Regisztráció</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="nev">Név *</label>
            <input type="text" id="nev" name="nev" value="{{ old('nev') }}" required autofocus>
            @error('nev')
            <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">E-mail cím *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Jelszó *</label>
            <input type="password" id="password" name="password" required>
            @error('password')
            <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Jelszó megerősítése *</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success" style="width: 100%;">Regisztráció</button>
    </form>

    <div style="margin-top: 1.5rem; text-align: center; padding-top: 1.5rem; border-top: 1px solid #ddd;">
        <p>Már van fiókod? <a href="{{ route('login') }}" style="color: #007bff;">Bejelentkezés</a></p>
    </div>
</div>
@endsection