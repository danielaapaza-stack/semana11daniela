@extends('layouts.app')

@section('titulo', $producto->nombre)

@section('contenido')

<a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm" style="margin-bottom:1.5rem; display:inline-block">&larr; VOLVER</a>

<div class="card" style="display:flex; gap:2rem; flex-wrap:wrap">

    <div style="flex:0 0 320px">
        @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
            <img src="{{ asset('img/productos/' . $producto->foto) }}" alt="{{ $producto->nombre }}" style="width:100%; border: 1px solid rgba(255, 0, 128, 0.15);{{ $producto->stock == 0 ? 'filter:grayscale(1);opacity:0.5;' : '' }}">
        @else
            <div class="no-foto" style="height:280px;{{ $producto->stock == 0 ? 'filter:grayscale(1);opacity:0.5;' : '' }}">Sin imagen</div>
        @endif
    </div>

    <div style="flex:1; min-width:260px">
        <h1 style="color: #fff; font-family: 'Orbitron', sans-serif; font-size: 1.4rem; letter-spacing: 2px; margin-bottom:.4rem; text-shadow: 0 0 15px rgba(255, 0, 128, 0.3);">
            {{ $producto->nombre }}
        </h1>
        <p style="color:#886688; margin-bottom:1rem; letter-spacing: 1px; text-transform: uppercase;">Marca: <strong style="color:#fff;">{{ $producto->marca }}</strong></p>

        <table style="margin-top:0">
            <tr>
                <td style="font-weight:600; width:140px; color: #886688;">Precio</td>
                <td style="color: #FF0080; font-weight: 700; text-shadow: 0 0 15px rgba(255, 0, 128, 0.3); font-size: 1.2rem;">S/. {{ number_format($producto->precio, 2) }}</td>
            </tr>
            <tr>
                <td style="font-weight:600; color: #886688;">Stock disponible</td>
                <td>{{ $producto->stock }} unidades @if($producto->stock == 0)<span style="color:#FF0044; margin-left:0.5rem; font-weight:700;">AGOTADO</span>@endif</td>
            </tr>
            <tr>
                <td style="font-weight:600; color: #886688;">Categoria</td>
                <td>{{ $producto->categoria->descripcion ?? 'Sin categoria' }}</td>
            </tr>
        </table>

        <div style="margin-top:1.5rem">
            @if($producto->stock > 0)
                <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">+ CARRITO</button>
                </form>
            @else
                <span class="btn" style="background:transparent; border:2px solid rgba(255,0,68,0.2); color:#FF0044; cursor:not-allowed; opacity:0.6; font-family:'Orbitron',sans-serif;">AGOTADO</span>
            @endif
        </div>
    </div>

</div>

@endsection