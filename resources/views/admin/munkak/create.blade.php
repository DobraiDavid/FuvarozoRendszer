@extends('layouts.app')

@section('title', 'Új munka létrehozása')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 style="margin-bottom: 1.5rem;">Új munka létrehozása</h2>

    <form method="POST" action="{{ route('admin.munkak.store') }}">
        @csrf

        <div class="form-group">
            <label for="indulas">Indulási cím *</label>
            <input type="text" id="indulas" name="indulas" value="{{ old('indulas') }}" required>
        </div>

        <div class="form-group">
            <label for="erkezes">Érkezési cím *</label>
            <input type="text" id="erkezes" name="erkezes" value="{{ old('erkezes') }}" required>
        </div>

        <div class="form-group">
            <label for="cimzett_neve">Címzett neve *</label>
            <input type="text" id="cimzett_neve" name="cimzett_neve" value="{{ old('cimzett_neve') }}" required>
        </div>

        <div class="form-group">
            <label for="cimzett_telefonszama">Címzett telefonszáma *</label>
            <input type="text" id="cimzett_telefonszama" name="cimzett_telefonszama" value="{{ old('cimzett_telefonszama') }}" required>
        </div>

        <div class="form-group">
            <label for="fuvarozo_id">Fuvarozó hozzárendelése</label>
            <select id="fuvarozo_id" name="fuvarozo_id">
                <option value="">-- Válassz fuvarozót --</option>
                @foreach($fuvarozok as $fuvarozo)
                <option value="{{ $fuvarozo->id }}" {{ old('fuvarozo_id') == $fuvarozo->id ? 'selected' : '' }}>
                {{ $fuvarozo->nev }} ({{ $fuvarozo->email }})
                </option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-success">Létrehozás</button>
            <a href="{{ route('admin.munkak.index') }}" class="btn btn-secondary">Mégse</a>
        </div>
    </form>
</div>
@endsection