@extends('layouts.app')

@section('title', 'Munkáim')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Hozzám rendelt munkák</h2>

    @forelse($munkak as $munka)
    <div class="card" style="margin-bottom: 1rem; background: #f9f9f9;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div style="flex: 1;">
                <h3 style="margin-bottom: 0.5rem;">Munka #{{ $munka->id }}</h3>

                <p><strong>Indulás:</strong> {{ $munka->indulas }}</p>
                <p><strong>Érkezés:</strong> {{ $munka->erkezes }}</p>
                <p><strong>Címzett:</strong> {{ $munka->cimzett_neve }}</p>
                <p><strong>Telefon:</strong> {{ $munka->cimzett_telefonszama }}</p>

                <p style="margin-top: 1rem;">
                    <strong>Jelenlegi státusz:</strong>
                    @php
                    $badgeClass = match($munka->status) {
                    'kiosztva' => 'badge-secondary',
                    'folyamatban' => 'badge-primary',
                    'elvegezve' => 'badge-success',
                    'sikertelen' => 'badge-danger',
                    };
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ ucfirst($munka->status) }}</span>
                </p>
            </div>

            <div style="min-width: 200px;">
                <form method="POST" action="{{ route('fuvarozo.munkak.updateStatus', $munka) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="status_{{ $munka->id }}"><strong>Státusz frissítése:</strong></label>
                        <select id="status_{{ $munka->id }}" name="status">
                            <option value="kiosztva" {{ $munka->status == 'kiosztva' ? 'selected' : '' }}>Kiosztva</option>
                            <option value="folyamatban" {{ $munka->status == 'folyamatban' ? 'selected' : '' }}>Folyamatban</option>
                            <option value="elvegezve" {{ $munka->status == 'elvegezve' ? 'selected' : '' }}>Elvégezve</option>
                            <option value="sikertelen" {{ $munka->status == 'sikertelen' ? 'selected' : '' }}>Sikertelen</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Frissítés</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div style="text-align: center; padding: 3rem; color: #666;">
        <p>Jelenleg nincs hozzád rendelt munka.</p>
    </div>
    @endforelse
</div>
@endsection