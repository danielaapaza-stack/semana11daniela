<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión – Productos App</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@400;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: #050005;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image:
                repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(255, 0, 128, 0.03) 2px, rgba(255, 0, 128, 0.03) 4px),
                radial-gradient(ellipse 80% 50% at 50% 30%, rgba(255, 0, 128, 0.08) 0%, transparent 60%),
                radial-gradient(ellipse 50% 30% at 80% 80%, rgba(255, 68, 176, 0.04) 0%, transparent 50%);
        }

        .login-box {
            background: rgba(13, 0, 10, 0.95);
            padding: 40px 35px;
            width: 380px;
            border: 2px solid var(--pink, #FF0080);
            box-shadow: 0 0 40px rgba(255, 0, 128, 0.08), inset 0 0 60px rgba(255, 0, 128, 0.02);
            position: relative;
        }
        .login-box::before {
            content: '';
            position: absolute;
            top: -2px; left: 20%;
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #fff, transparent);
            opacity: 0.3;
        }
        .login-box::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 20%;
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--pink, #FF0080), transparent);
            opacity: 0.5;
        }

        .login-box h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.4rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 4px;
            color: #fff;
            letter-spacing: 4px;
            text-shadow: 0 0 15px rgba(255, 0, 128, 0.5);
        }
        .login-box h1 span {
            color: var(--pink, #FF0080);
            text-shadow: 0 0 20px rgba(255, 0, 128, 0.7);
            animation: neonPulse 2s infinite;
        }
        .login-box .subtitle {
            color: #886688;
            font-size: 0.8rem;
            text-align: center;
            margin-bottom: 28px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        @keyframes neonPulse {
            0%, 100% { text-shadow: 0 0 7px rgba(255, 0, 128, 0.5); }
            50% { text-shadow: 0 0 20px rgba(255, 0, 128, 0.8), 0 0 40px rgba(255, 0, 128, 0.4); }
        }

        .form-group { margin-bottom: 18px; }
        label {
            display: block;
            font-size: 0.75rem;
            color: #AA88AA;
            margin-bottom: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        input[type=email], input[type=password] {
            width: 100%;
            padding: 11px 14px;
            background: rgba(255, 255, 255, 0.02);
            border: 1.5px solid rgba(255, 0, 128, 0.1);
            font-size: 0.9rem;
            color: #fff;
            transition: all 0.25s;
            font-family: 'Rajdhani', sans-serif;
        }
        input:focus {
            outline: none;
            border-color: #FF0080;
            box-shadow: 0 0 25px rgba(255, 0, 128, 0.08);
            background: rgba(255, 0, 128, 0.02);
        }
        .input-error { border-color: #FF0044 !important; }
        .error-msg { color: #FF0044; font-size: 0.75rem; margin-top: 4px; text-transform: uppercase; letter-spacing: 0.5px; }
        .alert { padding: 10px 14px; margin-bottom: 18px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .alert-danger { background: rgba(255, 0, 68, 0.04); color: #FF0044; border-left: 3px solid #FF0044; }
        .alert-success { background: rgba(0, 255, 136, 0.04); color: #00FF88; border-left: 3px solid #00FF88; }
        .alert-info { background: rgba(41, 121, 255, 0.04); color: #2979FF; border-left: 3px solid #2979FF; }
        .btn-login {
            width: 100%;
            background: transparent;
            color: var(--pink, #FF0080);
            border: 2px solid var(--pink, #FF0080);
            padding: 12px;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.8rem;
            cursor: pointer;
            font-weight: 700;
            margin-top: 8px;
            transition: all 0.3s ease;
            letter-spacing: 3px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 0, 128, 0.2), transparent);
            transition: left 0.5s;
        }
        .btn-login:hover::before { left: 100%; }
        .btn-login:hover {
            background: var(--pink, #FF0080);
            color: #000;
            box-shadow: 0 0 35px rgba(255, 0, 128, 0.4);
        }
        .hint {
            background: rgba(255, 255, 255, 0.01);
            padding: 14px;
            margin-top: 24px;
            font-size: 0.75rem;
            color: #886688;
            border-left: 3px solid rgba(255, 0, 128, 0.15);
            letter-spacing: 0.5px;
        }
        .hint strong { color: var(--pink, #FF0080); }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>PRODUCTOS <span>APP</span></h1>
        <p class="subtitle">Ingrese sus credenciales para continuar</p>
 
        {{-- Mensajes de sesión (éxito, info) --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
 
        {{-- Error general de credenciales --}}
        @if($errors->has('email') && !$errors->has('password'))
            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
        @endif
 
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
 
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="{{ $errors->has('email') ? 'input-error' : '' }}"
                       placeholder="ejemplo@correo.com">
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
 
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password"
                       class="{{ $errors->has('password') ? 'input-error' : '' }}"
                       placeholder="••••••••">
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
 
            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>
 
        <div class="hint">
            <strong>Credenciales de prueba:</strong><br>
            Admin: admin@productosapp.com / admin123<br>
            Demo:  demo@productosapp.com  / demo123
        </div>
    </div>
</body>
</html>
