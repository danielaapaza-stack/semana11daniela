@extends('layouts.app')

@section('titulo', 'Confirmar Pedido')

@section('contenido')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem;">
    <h1 style="color: #fff; font-family: 'Orbitron', sans-serif; font-size: 1.3rem; letter-spacing: 2px; text-transform: uppercase; margin:0; text-shadow: 0 0 15px rgba(255, 0, 128, 0.3);">
        Confirmar Pedido
    </h1>
    <a href="{{ route('carrito.index') }}" class="btn btn-outline btn-sm">&larr; VOLVER AL CARRITO</a>
</div>

<div class="card" style="margin-bottom:1.5rem;">
    <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:1rem; margin-bottom:1rem;">
        <div>
            <div style="font-size:0.75rem; color:#886688; text-transform:uppercase; letter-spacing:1px;">Cliente</div>
            <div style="font-size:1.1rem; color:#fff; font-weight:600;">{{ Auth::user()->name }}</div>
        </div>
        <div>
            <div style="font-size:0.75rem; color:#886688; text-transform:uppercase; letter-spacing:1px;">Fecha</div>
            <div style="font-size:1.1rem; color:#fff; font-weight:600;">{{ $fecha }}</div>
        </div>
        <div>
            <div style="font-size:0.75rem; color:#886688; text-transform:uppercase; letter-spacing:1px;">Email</div>
            <div style="font-size:1.1rem; color:#fff; font-weight:600;">{{ Auth::user()->email }}</div>
        </div>
    </div>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio unit.</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $item)
            <tr>
                <td>
                    <strong style="color:#fff;">{{ $item['producto']->nombre }}</strong><br>
                    <span style="color:#886688; font-size:0.8rem;">{{ $item['producto']->marca }}</span>
                </td>
                <td>S/. {{ number_format($item['producto']->precio, 2) }}</td>
                <td>{{ $item['cantidad'] }}</td>
                <td style="color:#FF0080; font-weight:700;">S/. {{ number_format($item['subtotal'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display:flex; justify-content:flex-end; margin-top:1.5rem; gap:1rem; align-items:center; flex-wrap:wrap;">
        <form action="{{ route('carrito.vaciar') }}" method="POST">
            @csrf
            <button class="btn btn-outline">CANCELAR</button>
        </form>

        <div style="font-size:1.3rem; font-weight:900; color:#FF0080; text-shadow:0 0 20px rgba(255,0,128,0.3); font-family:'Orbitron',sans-serif;">
            TOTAL: S/. {{ number_format($total, 2) }}
        </div>

        <form action="{{ route('carrito.vaciar') }}" method="POST" style="display:inline">
            @csrf
            <button class="btn btn-primary" onclick="return confirm('¿Confirmar el pedido, {{ Auth::user()->name }}?')">
                CONFIRMAR PEDIDO
            </button>
        </form>
    </div>
</div>

@endsection
