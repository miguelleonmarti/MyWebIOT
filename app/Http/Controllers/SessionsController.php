<?php

namespace App\Http\Controllers;

use App\Carrito;
use App\Producto;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;

class SessionsController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }

        $elementos = Carrito::where('id_user', '=', auth()->user()->getAuthIdentifier())->get();

        foreach ($elementos as $elemento) {
            $producto = Producto::find($elemento->id_producto);
            \Cart::add($producto->id, $producto->nombre, 1, $producto->precio);
        }


        return redirect()->to('/');

    }

    public function destroy()
    {
        auth()->logout();

        \Cart::destroy();

        return redirect()->to('/');
    }
}
