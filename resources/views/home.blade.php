@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')

@auth
    <div class="alert alert-success">
        BIENVENIDO, <strong style="color: #fff;">{{ strtoupper(Auth::user()->name) }}</strong>. ACCESO CONCEDIDO.
    </div>
@endauth

<div class="card">
    <h1 style="color: #fff; font-family: 'Orbitron', sans-serif; font-size: 1.5rem; letter-spacing: 3px; text-transform: uppercase; margin-bottom: .3rem; text-shadow: 0 0 15px rgba(255, 0, 128, 0.3);">
        PANEL DE CONTROL
    </h1>
    <p style="color: #886688; margin-bottom: 2rem; font-size: 0.85rem; letter-spacing: 2px; text-transform: uppercase;">
        Resumen del cat&aacute;logo de productos
    </p>

    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:1.2rem">

        <div style="background: rgba(13, 0, 10, 0.8); border: 1px solid rgba(255, 0, 128, 0.15); color:#fff; padding:1.5rem; text-align:center;">
            <div style="font-size:2.8rem; font-weight:900; color: #FF0080; text-shadow: 0 0 25px rgba(255, 0, 128, 0.4); font-family: 'Orbitron', sans-serif;">
                {{ $totalCategorias }}
            </div>
            <div style="margin-top:.3rem; opacity:.7; letter-spacing: 3px; font-size: 0.75rem; text-transform: uppercase; color: #AA88AA;">
                Categorias
            </div>
        </div>

        <div style="background: rgba(13, 0, 10, 0.8); border: 1px solid rgba(255, 0, 128, 0.15); color:#fff; padding:1.5rem; text-align:center;">
            <div style="font-size:2.8rem; font-weight:900; color: #FF0080; text-shadow: 0 0 25px rgba(255, 0, 128, 0.4); font-family: 'Orbitron', sans-serif;">
                {{ $totalProductos }}
            </div>
            <div style="margin-top:.3rem; opacity:.7; letter-spacing: 3px; font-size: 0.75rem; text-transform: uppercase; color: #AA88AA;">
                Productos
            </div>
        </div>

    </div>

    <div style="margin-top:2.5rem; display:flex; gap:1rem; flex-wrap:wrap">
        <a href="{{ route('productos.galeria') }}" class="btn btn-primary">GALERIA</a>
        <a href="{{ route('categorias.index') }}" class="btn btn-outline">CATEGORIAS</a>
        <a href="{{ route('productos.index') }}" class="btn btn-outline">PRODUCTOS</a>
    </div>

</div>

@endsection
