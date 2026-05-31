<?php
 
namespace App\Http\Controllers;
 
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
 
class ProductoController extends Controller
{
    // Muestra la lista de todos los productos en formato tabla
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }
 
    // Muestra el detalle de un producto especifico
    public function show($id)
    {
        // Se cambió a 'id_producto' para que coincida con la llave primaria de tu base de datos
        $producto = Producto::with('categoria')->where('id_producto', $id)->firstOrFail();
        return view('productos.show', compact('producto'));
    }

    // Muestra la galeria de productos con fotos
    public function galeria(Request $request)
    {
        $categoriaId = $request->query('categoria');
        $query = Producto::with('categoria');
        if ($categoriaId) {
            $query->where('id_categoria', $categoriaId);
        }
        $productos = $query->get();
        $categorias = Categoria::all();
        return view('productos.galeria', compact('productos', 'categorias', 'categoriaId'));
    }
}
