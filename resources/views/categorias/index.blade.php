@extends('layouts.app')
@section('titulo', 'Categorias')
@section('contenido')
    <h1 style="color: #fff; font-family: 'Orbitron', sans-serif; font-size: 1.3rem; letter-spacing: 2px; text-transform: uppercase; margin-bottom:1.5rem; text-shadow: 0 0 15px rgba(255, 0, 128, 0.3);">
        Categorias
        <span style="font-size:0.75rem; font-weight:400; color:#886688; letter-spacing:1px;">({{ $categorias->count() }} registros)</span>
    </h1>

    @if($categorias->isEmpty())
        <p style="color:#886688; letter-spacing: 1px;">No hay categor&iacute;as registradas a&uacute;n.</p>
    @else
        <table>
            <thead><tr><th>#</th><th>Descripci&oacute;n</th><th>N&deg; Productos</th></tr></thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id_categoria }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>
                            <span class="badge-categoria badge-stock-ok">
                                {{ $categoria->productos->count() }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
