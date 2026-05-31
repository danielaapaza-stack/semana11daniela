@extends('layouts.app')

@section('titulo', 'Galeria')

@section('contenido')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem;">
    <h1 style="color: #fff; font-family: 'Orbitron', sans-serif; font-size: 1.3rem; letter-spacing: 2px; text-transform: uppercase; margin:0; text-shadow: 0 0 15px rgba(255, 0, 128, 0.3);">
        Galeria
        <span style="font-size:0.8rem; font-weight:400; color:#886688; letter-spacing: 1px;">
            ({{ $productos->count() }} productos)
        </span>
    </h1>
    <a href="{{ route('productos.index') }}" class="btn btn-outline btn-sm">TABLA</a>
</div>

<div style="display:flex; gap:1rem; margin-bottom:1.5rem; flex-wrap:wrap; align-items:center;">
    <select id="filtro-categoria" onchange="window.location='{{ route('productos.galeria') }}?categoria='+this.value"
            style="background:rgba(255,255,255,0.02); border:1.5px solid rgba(255,0,128,0.1); color:#fff; padding:0.5rem 1rem; font-family:'Rajdhani',sans-serif; font-size:0.85rem; letter-spacing:1px; text-transform:uppercase; cursor:pointer;">
        <option value="" {{ !$categoriaId ? 'selected' : '' }}>Todas las categorias</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id_categoria }}" {{ $categoriaId == $cat->id_categoria ? 'selected' : '' }}>{{ $cat->descripcion }}</option>
        @endforeach
    </select>

    <input type="text" id="buscador" placeholder="BUSCAR PRODUCTO..."
           style="flex:1; min-width:200px; background:rgba(255,255,255,0.02); border:1.5px solid rgba(255,0,128,0.1); color:#fff; padding:0.5rem 1rem; font-family:'Rajdhani',sans-serif; font-size:0.85rem; letter-spacing:1px;">
</div>

@if($productos->isEmpty())
    <div class="alert alert-info">No hay productos registrados aun.</div>
@else
    <div class="galeria-grid" id="galeria-grid">
        @foreach($productos as $producto)
        <div class="producto-card" data-nombre="{{ strtolower($producto->nombre) }}">

            @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
                <img src="{{ asset('img/productos/' . $producto->foto) }}" alt="{{ $producto->nombre }}" style="{{ $producto->stock == 0 ? 'filter:grayscale(1);opacity:0.5;' : '' }}">
            @else
                <div class="no-foto" style="{{ $producto->stock == 0 ? 'filter:grayscale(1);opacity:0.5;' : '' }}">Sin imagen</div>
            @endif

            <div class="card-body">
                <h3>{{ $producto->nombre }}</h3>
                <p class="marca">{{ $producto->marca }}</p>

                @if($producto->stock == 0)
                    <span class="badge-categoria badge-stock-low" style="align-self:flex-start;">AGOTADO</span>
                @elseif($producto->stock > 20)
                    <span class="badge-categoria badge-stock-ok" style="align-self:flex-start;">Stock: {{ $producto->stock }}</span>
                @elseif($producto->stock > 5)
                    <span class="badge-categoria badge-stock-warn" style="align-self:flex-start;">Stock: {{ $producto->stock }}</span>
                @else
                    <span class="badge-categoria badge-stock-low" style="align-self:flex-start;">Stock bajo: {{ $producto->stock }}</span>
                @endif

                <p class="precio">S/. {{ number_format($producto->precio, 2) }}</p>
            </div>

            <div class="card-footer">
                <span class="badge-categoria">{{ $producto->categoria->descripcion ?? 'Sin cat.' }}</span>
                <div style="display:flex; gap:.4rem">
                    <a href="{{ route('productos.show', $producto->id_producto) }}" class="btn btn-outline btn-sm">VER</a>
                    @if($producto->stock > 0)
                        <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">+ CARRITO</button>
                        </form>
                    @else
                        <span class="btn btn-sm" style="background:transparent; border:1px solid rgba(255,0,68,0.2); color:#FF0044; cursor:not-allowed; opacity:0.6;">AGOTADO</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection

@push('scripts')
<script>
    document.getElementById('buscador').addEventListener('keyup', function() {
        var filtro = this.value.toLowerCase().trim();
        var cards = document.querySelectorAll('.producto-card');
        cards.forEach(function(card) {
            var nombre = card.getAttribute('data-nombre');
            card.style.display = nombre.includes(filtro) ? '' : 'none';
        });
    });
</script>
@endpush
