<?php

namespace App\Http\Controllers;

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
        }

        return redirect('/buyProduct');
    }

    public function increase() {

    }

    public function decrease() {

    }

    # Our function for removing a certain product from the cart
    public function removeFromCart(Request $request)
    {
        \Cart::remove($request->rowId);
        return redirect('/');
    }

    # Our function for clearing all items from our cart
    public function destroyCart()
    {
        \Cart::destroy();
        return redirect('/');
    }
}
