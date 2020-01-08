<?php

namespace App\Http\Controllers;

use App\Carrito;
use App\Producto;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;

class WebstoreController extends Controller
{
    # Añadir al carrito una unidad de un producto sin pasar el stock disponible
    public function addToCart($id)
    {
        $producto = Producto::find($id);
        $cantidad = 0;
        foreach (\Cart::content() as $cartItem) {
            if ($cartItem->name == $producto->nombre) {
                $cantidad = $cartItem->qty;
            }
        }

        if ($cantidad < $producto->cantidad) {
            \Cart::add($producto->id, $producto->nombre, 1, $producto->precio);
            if(auth()->check()) {
                $elemento = new Carrito();
                $elemento['id_user'] = auth()->user()->getAuthIdentifier();
                $elemento['id_producto'] = $producto->id;
                $elemento->save();
            }
        }

        return redirect('/buyProduct');
    }

    public function minus($id, $rowId) {
        $producto = Producto::find($id);
        $cantidad = 0;
        foreach (\Cart::content() as $cartItem) {
            if ($cartItem->name == $producto->nombre) {
                $cantidad = $cartItem->qty;
            }
        }

        if ($cantidad == 1) {
            \Cart::remove($rowId);
        } else {
            \Cart::add($producto->id, $producto->nombre, -1, $producto->precio);
        }

        if (auth()->check()) {
            $elemento = Carrito::where('id_user', '=', auth()->user()->getAuthIdentifier())->where('id_producto', '=', $producto->id)->first();
            $elemento->delete();
        }

        return redirect('/buyProduct');
    }

    # Our function for removing a certain product from the cart
    public function removeFromCart(Request $request)
    {
        \Cart::remove($request->rowId); //TODO: QUITAR
        return redirect('/');
    }

    # Our function for clearing all items from our cart
    public function destroyCart()
    {
        \Cart::destroy();
        $elementos = Carrito::where('id_user', '=', auth()->user()->getAuthIdentifier())->get();
        foreach($elementos as $elemento) {
            $elemento->delete();
        }

        return redirect('/');
    }
}
