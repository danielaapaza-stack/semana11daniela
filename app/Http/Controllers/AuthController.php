<?php

namespace App\Http\Controllers;

use App\Models\CarritoItem; // Asegúrate de que este modelo exista en tu proyecto
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    /**
     * Procesa el formulario de login y fusiona el carrito de invitado con la BD.
     */
    public function login(Request $request)
    {
        // 1. Validar campos del formulario
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Ingrese un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        // 2. RESPALDO: Guardar el carrito temporal que armó mientras era visitante/invitado
        $sessionCarrito = session('carrito', []);

        // 3. Intentar autenticar al usuario
        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            // Autenticación exitosa: se regenera la sesión por seguridad
            $request->session()->regenerate(); 

            $userId = Auth::id();

            // 4. FUSIONAR: Pasar los productos de la sesión temporal a la Base de Datos
            if (!empty($sessionCarrito)) {
                foreach ($sessionCarrito as $productoId => $cantidad) {
                    
                    // Buscamos si el usuario ya tenía guardado este producto antes en la BD
                    // Nota: Se asume que tu tabla usa 'user_id' e 'id_producto' como llaves correspondientes
                    $item = CarritoItem::where('user_id', $userId)
                        ->where('id_producto', $productoId)
                        ->first();

                    if ($item) {
                        // Si ya existía en la BD, sumamos la cantidad seleccionada como invitado
                        $item->cantidad += $cantidad;
                        $item->save();
                    } else {
                        // Si es nuevo, registramos la fila en la BD enlazada al usuario logueado
                        CarritoItem::create([
                            'user_id'     => $userId,
                            'id_producto' => $productoId,
                            'cantidad'    => $cantidad,
                        ]);
                    }
                }

                // Opcional: Una vez migrado con éxito a la base de datos, limpiamos la sesión
                // para que el CarritoController lea directamente los elementos guardados.
                session()->forget('carrito');
            }

            return redirect()->route('home')->with('success', '¡Bienvenido, ' . Auth::user()->name . '!');
        }

        // Credenciales incorrectas
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión del usuario actual de forma limpia.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('info', 'Ha cerrado sesión correctamente.');
    }
}