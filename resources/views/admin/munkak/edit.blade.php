@extends('layouts.app')

@section('title', 'Munka szerkesztése')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 style="margin-bottom: 1.5rem;">Munka szerkesztése #{{ $munka->id }}</h2>

    <form method="POST" action="{{ route('admin.munkak.update', $munka) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="indulas">Indulási cím *</label>
            <input type="text" id="indulas" name="indulas" value="{{ old('indulas', $munka->indulas) }}" required>
        </div>

        <div class="form-group">
            <label for="erkezes">Érkezési cím *</label>
            <input type="text" id="erkezes" name="erkezes" value="{{ old('erkezes', $munka->erkezes) }}" required>
        </div>

        <div class="form-group">
            <label for="cimzett_neve">Címzett neve *</label>
            <input type="text" id="cimzett_neve" name="cimzett_neve" value="{{ old('cimzett_neve', $munka->cimzett_neve) }}" required>
        </div>

        <div class="form-group">
            <label for="cimzett_telefonszama">Címzett telefonszáma *</label>
            <input type="text" id="cimzett_telefonszama" name="cimzett_telefonszama" value="{{ old('cimzett_telefonszama', $munka->cimzett_telefonszama) }}" required>
        </div>

        <div class="form-group">
            <label for="status">Státusz *</label>
            <select id="status" name="status" required>
                <option value="kiosztva" {{ old('status', $munka->status) == 'kiosztva' ? 'selected' : '' }}>Kiosztva</option>
                <option value="folyamatban" {{ old('status', $munka->status) == 'folyamatban' ? 'selected' : '' }}>Folyamatban</option>
                <option value="elvegezve" {{ old('status', $munka->status) == 'elvegezve' ? 'selected' : '' }}>Elvégezve</option>
                <option value="sikertelen" {{ old('status', $munka->status) == 'sikertelen' ? 'selected' : '' }}>Sikertelen</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fuvarozo_id">Fuvarozó hozzárendelése</label>
            <select id="fuvarozo_id" name="fuvarozo_id">
                <option value="">-- Nincs hozzárendelve --</option>
                @foreach($fuvarozok as $fuvarozo)
                <option value="{{ $fuvarozo->id }}" {{ old('fuvarozo_id', $munka->fuvarozo_id) == $fuvarozo->id ? 'selected' : '' }}>
                {{ $fuvarozo->nev }} ({{ $fuvarozo->email }})
                </option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-success">Mentés</button>
            <a href="{{ route('admin.munkak.index') }}" class="btn btn-secondary">Mégse</a>
        </div>
    </form>
</div>
@endsection