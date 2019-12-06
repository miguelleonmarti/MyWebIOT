<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;

class WebstoreController extends Controller
{
    # Our function for adding a certain product to the cart
    public function addToCart($id)
    {
        $producto = Producto::find($id);
        \Cart::add($producto->id, $producto->nombre, 1, $producto->precio);
        return redirect('/buyProduct');
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
