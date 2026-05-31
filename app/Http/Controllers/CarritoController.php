<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CarritoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    private function getCarrito()
    {
        if (Auth::check()) {
            return CarritoItem::where('user_id', Auth::id())
                ->with('producto')
                ->get()
                ->keyBy('producto_id')
                ->map(function ($item) {
                    return $item->cantidad;
                })
                ->toArray();
        }
        return session('carrito', []);
    }

    private function guardarCarrito(array $carrito)
    {
        if (Auth::check()) {
            foreach ($carrito as $id => $cantidad) {
                CarritoItem::updateOrCreate(
                    ['user_id' => Auth::id(), 'producto_id' => $id],
                    ['cantidad' => $cantidad]
                );
            }
            CarritoItem::where('user_id', Auth::id())
                ->whereNotIn('producto_id', array_keys($carrito))
                ->delete();
        } else {
            session(['carrito' => $carrito]);
        }
    }

    public function index()
    {
        $carrito   = $this->getCarrito();
        $productos = [];
        $total     = 0;

        foreach ($carrito as $id => $cantidad) {
            $producto = Producto::where('id_producto', $id)->first();

            if ($producto) {
                $subtotal    = $producto->precio * $cantidad;
                $total      += $subtotal;
                $productos[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('carrito.index', compact('productos', 'total'));
    }

    public function agregar($id)
    {
        $producto = Producto::where('id_producto', $id)->firstOrFail();
        $carrito  = $this->getCarrito();

        if (isset($carrito[$id])) {
            if ($carrito[$id] < $producto->stock) {
                $carrito[$id]++;
            } else {
                return back()->with('error', 'No hay m\u00e1s stock disponible de ' . $producto->nombre);
            }
        } else {
            $carrito[$id] = 1;
        }

        $this->guardarCarrito($carrito);
        return back()->with('success', $producto->nombre . ' agregado al carrito.');
    }

    public function quitar($id)
    {
        $carrito = $this->getCarrito();

        if (isset($carrito[$id])) {
            if ($carrito[$id] > 1) {
                $carrito[$id]--;
            } else {
                unset($carrito[$id]);
            }
        }

        $this->guardarCarrito($carrito);
        return back()->with('info', 'Producto actualizado en el carrito.');
    }

    public function confirmar()
    {
        $carrito   = $this->getCarrito();
        $productos = [];
        $total     = 0;

        foreach ($carrito as $id => $cantidad) {
            $producto = Producto::where('id_producto', $id)->first();
            if ($producto) {
                $subtotal    = $producto->precio * $cantidad;
                $total      += $subtotal;
                $productos[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ];
            }
        }

        $fecha = now()->format('d/m/Y H:i');
        return view('carrito.confirmar', compact('productos', 'total', 'fecha'));
    }

    public function vaciar()
    {
        if (Auth::check()) {
            CarritoItem::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('carrito');
        }
        return back()->with('info', 'El carrito ha sido vaciado.');
    }
}
