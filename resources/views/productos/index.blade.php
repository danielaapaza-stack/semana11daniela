@extends('layouts.app')
@section('titulo', 'Productos')
@section('contenido')
    <h1 style="color: #fff; font-family: 'Orbitron', sans-serif; font-size: 1.3rem; letter-spacing: 2px; text-transform: uppercase; margin-bottom:1.5rem; text-shadow: 0 0 15px rgba(255, 0, 128, 0.3);">
        Productos
        <span style="font-size:0.75rem; font-weight:400; color:#886688; letter-spacing:1px;">({{ $productos->count() }} registros)</span>
    </h1>

    @if($productos->isEmpty())
        <p style="color:#886688; letter-spacing: 1px;">No hay productos registrados a&uacute;n.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th><th>Nombre</th><th>Marca</th>
                    <th>Precio (S/.)</th><th>Stock</th><th>Categor&iacute;a</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id_producto }}</td>
                        <td><strong>{{ $producto->nombre }}</strong></td>
                        <td>{{ $producto->marca }}</td>
                        <td style="color: #FF0080; font-weight: 700;">S/. {{ number_format($producto->precio, 2) }}</td>
                        <td>
                            @if($producto->stock > 20)
                                <span class="badge-categoria badge-stock-ok">{{ $producto->stock }}</span>
                            @elseif($producto->stock > 5)
                                <span class="badge-categoria badge-stock-warn">{{ $producto->stock }}</span>
                            @else
                                <span class="badge-categoria badge-stock-low">{{ $producto->stock }} ⚠</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge-categoria">
                                {{ $producto->categoria->descripcion ?? 'Sin categor&iacute;a' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
