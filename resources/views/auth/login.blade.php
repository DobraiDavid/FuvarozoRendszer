@extends('layouts.app')

@section('title', 'Bejelentkezés')

@section('content')
<div class="card" style="max-width: 400px; margin: 3rem auto;">
    <h2 style="margin-bottom: 1.5rem;">Bejelentkezés</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">E-mail cím</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Jelszó</label>
            <input type="password" id="password" name="password" required>
        </div>


        <button type="submit" class="btn btn-primary" style="width: 100%;">Bejelentkezés</button>
    </form>

    <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #ddd;">
        <p style="text-align: center;">
            Nincs még fiókod? <a href="{{ route('register') }}" style="color: #007bff;">Regisztráció</a>
        </p>

        <p style="margin-top: 1rem;"><strong>Teszt fiók adatok:</strong></p>
        <p>Admin: admin@fuvarozo.hu / password</p>
        <p>Fuvarozó: kovacs@fuvarozo.hu / password</p>
    </div>
</div>
@endsection