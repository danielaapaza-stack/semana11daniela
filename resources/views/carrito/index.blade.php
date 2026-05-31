@extends('layouts.app')

@section('titulo', 'Mi Carrito')

@section('contenido')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
    <h1 style="color: #fff; font-family: 'Orbitron', sans-serif; font-size: 1.3rem; letter-spacing: 2px; text-transform: uppercase; margin:0; text-shadow: 0 0 15px rgba(255, 0, 128, 0.3);">
        Carrito de Compras
    </h1>
    <a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm">
        &larr; SEGUIR COMPRANDO
    </a>
</div>

@if(empty($productos))
    <div class="card" style="text-align:center; padding:3rem">
        <p style="font-size:1rem; color:#886688; margin-bottom:1.5rem; letter-spacing: 2px; text-transform: uppercase;">
            Tu carrito est&aacute; vac&iacute;o.
        </p>
        <a href="{{ route('productos.galeria') }}" class="btn btn-primary">
            VER GALERIA
        </a>
    </div>
@else
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th style="width:80px">Imagen</th>
                    <th>Producto</th>
                    <th>Precio unit.</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $item)
                <tr>
                    <td>
                        @if($item['producto']->foto && file_exists(public_path('img/productos/' . $item['producto']->foto)))
                            <img src="{{ asset('img/productos/' . $item['producto']->foto) }}"
                                 style="width:60px; height:60px; object-fit:cover; border: 1px solid rgba(255, 0, 128, 0.15);">
                        @else
                            <div style="width:60px; height:60px; background: rgba(255, 0, 128, 0.03); border: 1px dashed rgba(255, 0, 128, 0.2); display:flex; align-items:center; justify-content:center; font-size:0.65rem; color:#886688; text-transform:uppercase; letter-spacing:1px;">Sin foto</div>
                        @endif
                    </td>
                    <td>
                        <strong style="color: #fff;">{{ $item['producto']->nombre }}</strong><br>
                        <span style="color:#886688; font-size:.82rem">{{ $item['producto']->marca }}</span>
                    </td>
                    <td>S/. {{ number_format($item['producto']->precio, 2) }}</td>
                    <td>
                        <div style="display:flex; align-items:center; gap:.5rem">
                            <form action="{{ route('carrito.quitar', $item['producto']->id_producto) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm" style="padding: 0.1rem 0.5rem;">-</button>
                            </form>
                            <strong style="color: #FF0080; font-size: 1.1rem; text-shadow: 0 0 10px rgba(255, 0, 128, 0.3);">{{ $item['cantidad'] }}</strong>
                            <form action="{{ route('carrito.agregar', $item['producto']->id_producto) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm" style="padding: 0.1rem 0.5rem;">+</button>
                            </form>
                        </div>
                    </td>
                    <td style="color: #FF0080; font-weight: 700;">S/. {{ number_format($item['subtotal'], 2) }}</td>
                    <td>
                        <form action="{{ route('carrito.quitar', $item['producto']->id_producto) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm" onclick="return confirm('&iquest;Quitar este producto del carrito?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="display:flex; justify-content:flex-end; margin-top:1.5rem; gap:1rem; align-items:center; flex-wrap:wrap;">
            <form action="{{ route('carrito.vaciar') }}" method="POST">
                @csrf
                <button class="btn btn-outline" onclick="return confirm('&iquest;Vaciar el carrito?')">
                    VACIAR
                </button>
            </form>

            <div style="font-size:1.3rem; font-weight:900; color:#FF0080; text-shadow: 0 0 20px rgba(255, 0, 128, 0.3); margin-right: 1rem; font-family: 'Orbitron', sans-serif;">
                TOTAL: S/. {{ number_format($total, 2) }}
            </div>

            <a href="{{ route('carrito.confirmar') }}" class="btn btn-primary">
                CONFIRMAR PEDIDO
            </a>
        </div>
    </div>
@endif

@endsection
