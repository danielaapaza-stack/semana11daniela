<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'ProductosApp') | DAI</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@400;600;700&display=swap');

        :root {
            --pink:       #FF0080;
            --pink2:      #FF44B0;
            --pink-dark:  #1A0010;
            --pink-glow:  rgba(255, 0, 128, 0.7);
            --bg:         #050005;
            --card-bg:    #0D000A;
            --text:       #FFFFFF;
            --text-dim:   #AA88AA;
            --radius:     8px;
        }

        @keyframes bgPulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.8; }
        }
        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 1px); }
            40% { transform: translate(2px, -1px); }
            60% { transform: translate(-1px, -1px); }
            80% { transform: translate(1px, 2px); }
            100% { transform: translate(0); }
        }
        @keyframes borderFlicker {
            0%, 100% { border-color: var(--pink); }
            50% { border-color: #FF66C4; }
        }
        @keyframes scanline {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100vh); }
        }
        @keyframes neonPulse {
            0%, 100% { text-shadow: 0 0 7px var(--pink), 0 0 20px var(--pink-glow); }
            50% { text-shadow: 0 0 15px var(--pink), 0 0 40px var(--pink-glow), 0 0 60px var(--pink); }
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background:
                repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(255, 0, 128, 0.03) 2px, rgba(255, 0, 128, 0.03) 4px),
                radial-gradient(ellipse 100% 60% at 50% -20%, rgba(255, 0, 128, 0.12) 0%, transparent 70%),
                radial-gradient(ellipse 60% 40% at 20% 80%, rgba(255, 68, 176, 0.06) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        body {
            font-family: 'Rajdhani', 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }
        body > * { position: relative; z-index: 1; }

        a { color: var(--pink2); text-decoration: none; transition: all 0.3s ease; }
        a:hover { color: #fff; text-shadow: 0 0 15px var(--pink-glow); }

        h1, h2, h3, .navbar .brand { font-family: 'Orbitron', sans-serif; }

        .navbar {
            background: rgba(5, 0, 5, 0.95);
            backdrop-filter: blur(8px);
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--pink);
            box-shadow: 0 0 30px rgba(255, 0, 128, 0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar .brand {
            font-size: 1.3rem;
            font-weight: 900;
            letter-spacing: 4px;
            color: #fff;
            text-shadow: 0 0 10px var(--pink-glow);
        }
        .navbar .brand span {
            color: var(--pink);
            animation: neonPulse 2s infinite;
        }
        .navbar nav a {
            color: var(--text-dim);
            margin-left: 1.5rem;
            font-size: .85rem;
            font-weight: 600;
            transition: all .3s;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0.3rem 0;
            border-bottom: 1px solid transparent;
        }
        .navbar nav a:hover {
            color: var(--pink);
            border-bottom-color: var(--pink);
            text-shadow: 0 0 15px var(--pink-glow);
        }
        .navbar .carrito-btn {
            background: transparent;
            color: var(--pink);
            border: 2px solid var(--pink);
            padding: .35rem 1.2rem;
            cursor: pointer;
            font-family: 'Orbitron', sans-serif;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: 1px;
            transition: all .3s ease;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }
        .navbar .carrito-btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 0, 128, 0.2), transparent);
            transition: left 0.5s;
        }
        .navbar .carrito-btn:hover::before { left: 100%; }
        .navbar .carrito-btn:hover {
            background: var(--pink);
            color: #000;
            box-shadow: 0 0 30px var(--pink-glow);
        }

        .main-content { max-width: 1200px; margin: 2rem auto; padding: 0 1.5rem; }

        .card {
            background: linear-gradient(135deg, rgba(13, 0, 10, 0.9), rgba(5, 0, 5, 0.9));
            border-radius: var(--radius);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8), inset 0 0 30px rgba(255, 0, 128, 0.02);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 0, 128, 0.15);
            transition: all 0.3s ease;
        }
        .card:hover {
            border-color: rgba(255, 0, 128, 0.4);
            box-shadow: 0 0 30px rgba(255, 0, 128, 0.06), inset 0 0 40px rgba(255, 0, 128, 0.02);
        }

        .btn {
            display: inline-block;
            padding: .55rem 1.5rem;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: .75rem;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all .3s ease;
            text-align: center;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.4s;
        }
        .btn:hover::before { left: 100%; }
        .btn-primary {
            background: var(--pink);
            color: #000;
            border-color: var(--pink);
            box-shadow: 0 0 20px rgba(255, 0, 128, 0.3);
        }
        .btn-primary:hover {
            background: #FF44B0;
            border-color: #FF44B0;
            box-shadow: 0 0 40px var(--pink-glow);
            transform: scale(1.03);
        }
        .btn-success {
            background: #000;
            color: #00FF88;
            border-color: #00FF88;
            box-shadow: 0 0 15px rgba(0, 255, 136, 0.15);
        }
        .btn-success:hover {
            background: #00FF88;
            color: #000;
            box-shadow: 0 0 30px rgba(0, 255, 136, 0.4);
            transform: scale(1.03);
        }
        .btn-danger {
            background: #000;
            color: #FF0044;
            border-color: #FF0044;
            box-shadow: 0 0 15px rgba(255, 0, 68, 0.15);
        }
        .btn-danger:hover {
            background: #FF0044;
            color: #000;
            box-shadow: 0 0 30px rgba(255, 0, 68, 0.4);
            transform: scale(1.03);
        }
        .btn-outline {
            background: transparent;
            border-color: var(--pink);
            color: var(--pink);
        }
        .btn-outline:hover {
            background: var(--pink);
            color: #000;
            box-shadow: 0 0 30px var(--pink-glow);
        }
        .btn-sm { padding: .3rem 1rem; font-size: .7rem; }

        .galeria-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        .producto-card {
            background: linear-gradient(145deg, rgba(13, 0, 10, 0.95), rgba(5, 0, 5, 0.95));
            border-radius: var(--radius);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.8);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(255, 0, 128, 0.12);
            position: relative;
        }
        .producto-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 10%; width: 80%; height: 1px;
            background: linear-gradient(90deg, transparent, var(--pink), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .producto-card:hover::after { opacity: 0.5; }
        .producto-card:hover {
            transform: translateY(-6px);
            border-color: var(--pink);
            box-shadow: 0 0 35px rgba(255, 0, 128, 0.15);
        }
        .producto-card img {
            width: 100%; height: 200px; object-fit: cover;
            border-bottom: 1px solid rgba(255, 0, 128, 0.08);
        }
        .producto-card .no-foto {
            width: 100%; height: 200px;
            background: repeating-linear-gradient(45deg, #0A0008, #0A0008 10px, #10000C 10px, #10000C 20px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dim);
            font-size: .8rem;
            border-bottom: 1px solid rgba(255, 0, 128, 0.08);
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .producto-card .card-body {
            padding: 1rem 1.2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .producto-card .card-body h3 {
            font-size: 1rem;
            margin-bottom: .2rem;
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .producto-card .card-body .marca {
            color: var(--text-dim);
            font-size: .8rem;
            margin-bottom: .8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .producto-card .card-body .precio {
            font-size: 1.2rem;
            font-weight: 900;
            color: var(--pink);
            margin-top: auto;
            text-shadow: 0 0 20px rgba(255, 0, 128, 0.4);
            letter-spacing: 1px;
        }
        .producto-card .card-footer {
            padding: .7rem 1.2rem;
            border-top: 1px solid rgba(255, 0, 128, 0.06);
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            gap: .5rem;
            justify-content: space-between;
            align-items: center;
        }
        .badge-categoria {
            background: rgba(255, 0, 128, 0.06);
            color: var(--pink2);
            padding: .2rem .7rem;
            font-size: .7rem;
            font-weight: 600;
            border: 1px solid rgba(255, 0, 128, 0.12);
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .badge-stock-ok   { background: rgba(0, 255, 136, 0.06); color: #00FF88; border-color: rgba(0, 255, 136, 0.15); }
        .badge-stock-warn { background: rgba(255, 171, 0, 0.06); color: #FFAB00; border-color: rgba(255, 171, 0, 0.15); }
        .badge-stock-low  { background: rgba(255, 0, 68, 0.06); color: #FF0044; border-color: rgba(255, 0, 68, 0.15); }

        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th {
            background: rgba(255, 0, 128, 0.06);
            color: var(--pink);
            padding: .8rem 1rem;
            text-align: left;
            font-size: .78rem;
            font-weight: 700;
            border-bottom: 2px solid var(--pink);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-family: 'Orbitron', sans-serif;
        }
        td {
            padding: .75rem 1rem;
            border-bottom: 1px solid rgba(255, 0, 128, 0.05);
            font-size: .88rem;
            color: var(--text);
        }
        tr:hover td { background: rgba(255, 0, 128, 0.04); }

        .alert {
            padding: .9rem 1.4rem;
            margin-bottom: 1.5rem;
            font-size: .85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .alert-success { background: rgba(0, 255, 136, 0.04); border-left: 3px solid #00FF88; color: #00FF88; }
        .alert-danger  { background: rgba(255, 0, 68, 0.04); border-left: 3px solid #FF0044; color: #FF0044; }
        .alert-info    { background: rgba(41, 121, 255, 0.04); border-left: 3px solid #2979FF; color: #2979FF; }

        .form-group { margin-bottom: 1.2rem; }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: .4rem;
            font-size: .78rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: .7rem 1rem;
            background: rgba(255, 255, 255, 0.02);
            border: 1.5px solid rgba(255, 0, 128, 0.1);
            font-size: .88rem;
            color: #FFF;
            transition: all .25s;
            font-family: 'Rajdhani', sans-serif;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: var(--pink);
            box-shadow: 0 0 25px rgba(255, 0, 128, 0.06);
            background: rgba(255, 0, 128, 0.02);
        }
        .form-error { color: #FF0044; font-size: .75rem; margin-top: .2rem; text-transform: uppercase; letter-spacing: 0.5px; }

        .site-footer {
            text-align: center;
            padding: 1.5rem;
            margin-top: 4rem;
            color: var(--text-dim);
            font-size: .78rem;
            border-top: 1px solid rgba(255, 0, 128, 0.08);
            background: rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
            text-transform: uppercase;
        }
    </style>
    @stack('styles')
</head>
<body>
 
<div class="navbar">
    <a href="{{ route('home') }}" class="brand">Productos<span>App</span></a>
    <nav>
        @auth
            <a href="{{ route('productos.galeria') }}">Galeria</a>
            <a href="{{ route('productos.index') }}">Productos</a>
            <a href="{{ route('categorias.index') }}">Categorias</a>
            <a href="{{ route('carrito.index') }}" class="carrito-btn">
                Carrito
                @auth
                    @php $cartCount = \App\Models\CarritoItem::where('user_id', Auth::id())->sum('cantidad'); @endphp
                    @if($cartCount > 0)
                        ({{ $cartCount }})
                    @endif
                @else
                    @if(session('carrito') && count(session('carrito')) > 0)
                        ({{ array_sum(session('carrito')) }})
                    @endif
                @endauth
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-outline btn-sm" style="margin-left:1rem">
                    Cerrar sesion
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Iniciar sesion</a>
        @endauth
    </nav>
</div>
 
<div class="main-content">
 
    {{-- Mensajes flash de sesion --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif
 
    @yield('contenido')
</div>
 
<div class="site-footer">
    Desarrollo de Aplicaciones en Internet &mdash; Ciclo III &mdash; {{ date('Y') }}
</div>
 
@stack('scripts')
</body>
</html>