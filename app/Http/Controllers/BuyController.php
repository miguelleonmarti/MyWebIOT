<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function create() {
        $productos = Producto::all();
        return view('buyProduct')->with('productos', $productos);
    }
}
