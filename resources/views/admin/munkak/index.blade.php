@extends('layouts.app')

@section('title', 'Admin - Munkák kezelése')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Munkák kezelése</h2>
        <a href="{{ route('admin.munkak.create') }}" class="btn btn-success">+ Új munka</a>
    </div>

    <!-- Status Filter (Bonus Feature - Admin Only) -->
    <form method="GET" action="{{ route('admin.munkak.index') }}" style="margin-bottom: 1.5rem;">
        <div style="display: flex; gap: 1rem; align-items: center;">
            <label for="status" style="font-weight: bold;">Szűrés státusz szerint:</label>
            <select name="status" id="status" onchange="this.form.submit()" style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Összes --</option>
                <option value="kiosztva" {{ request('status') == 'kiosztva' ? 'selected' : '' }}>Kiosztva</option>
                <option value="folyamatban" {{ request('status') == 'folyamatban' ? 'selected' : '' }}>Folyamatban</option>
                <option value="elvegezve" {{ request('status') == 'elvegezve' ? 'selected' : '' }}>Elvégezve</option>
                <option value="sikertelen" {{ request('status') == 'sikertelen' ? 'selected' : '' }}>Sikertelen</option>
            </select>
            @if(request('status'))
            <a href="{{ route('admin.munkak.index') }}" class="btn btn-secondary" style="padding: 0.5rem 1rem;">Szűrő törlése</a>
            @endif
        </div>
    </form>

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