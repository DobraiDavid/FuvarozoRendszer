@extends('layouts.app')

@section('title', 'Admin - Munkák')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Munkák kezelése</h2>
        <a href="{{ route('admin.munkak.create') }}" class="btn btn-success">+ Új munka</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Indulás</th>
            <th>Érkezés</th>
            <th>Címzett</th>
            <th>Telefon</th>
            <th>Fuvarozó</th>
            <th>Státusz</th>
            <th>Műveletek</th>
        </tr>
        </thead>
        <tbody>
        @forelse($munkak as $munka)
        <tr>
            <td>{{ $munka->id }}</td>
            <td>{{ $munka->indulas }}</td>
            <td>{{ $munka->erkezes }}</td>
            <td>{{ $munka->cimzett_neve }}</td>
            <td>{{ $munka->cimzett_telefonszama }}</td>
            <td>{{ $munka->fuvarozo ? $munka->fuvarozo->nev : '-' }}</td>
            <td>
                @php
                $badgeClass = match($munka->status) {
                'kiosztva' => 'badge-secondary',
                'folyamatban' => 'badge-primary',
                'elvegezve' => 'badge-success',
                'sikertelen' => 'badge-danger',
                };
                @endphp
                <span class="badge {{ $badgeClass }}">{{ ucfirst($munka->status) }}</span>
            </td>
            <td>
                <div class="actions">
                    <a href="{{ route('admin.munkak.edit', $munka) }}" class="btn btn-warning">Szerkeszt</a>
                    <form method="POST" action="{{ route('admin.munkak.destroy', $munka) }}" onsubmit="return confirm('Biztosan törlöd?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Töröl</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center; padding: 2rem;">Nincs még munka létrehozva.</td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection