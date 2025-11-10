<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fuvarozó Rendszer')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        nav { background: #333; color: white; padding: 1rem; }
        nav .container { display: flex; justify-content: space-between; align-items: center; }
        nav h1 { font-size: 1.5rem; }
        nav a { color: white; text-decoration: none; margin-left: 1rem; }
        nav form { display: inline; }
        nav button { background: #f44336; color: white; border: none; padding: 0.5rem 1rem; cursor: pointer; border-radius: 4px; }
        .alert { padding: 1rem; margin: 1rem 0; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 1rem 0; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none; cursor: pointer; border: none; font-size: 1rem; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; color: white; }
        .btn:hover { opacity: 0.9; }
        table { width: 100%; border-collapse: collapse; }
        table th, table td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #ddd; }
        table th { background: #f8f9fa; font-weight: bold; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; }
        .badge { padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem; font-weight: bold; }
        .badge-secondary { background: #6c757d; color: white; }
        .badge-primary { background: #007bff; color: white; }
        .badge-success { background: #28a745; color: white; }
        .badge-danger { background: #dc3545; color: white; }
        .actions { display: flex; gap: 0.5rem; }
    </style>
</head>
<body>
<nav>
    <div class="container">
        <h1>Fuvarozó Rendszer</h1>
        <div>
            @auth('fuvarozo')
            <span>{{ Auth::guard('fuvarozo')->user()->nev }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Kijelentkezés</button>
            </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('warning'))
    <div class="alert" style="background: #fff3cd; color: #856404; border: 1px solid #ffeaa7;">
        ⚠️ {{ session('warning') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-error">
        <ul style="margin-left: 1.5rem;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @yield('content')
</div>
</body>
</html>