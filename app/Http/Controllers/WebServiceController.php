<?php

namespace App\Http\Controllers;

use App\Canal;
use App\Sugerencia;
use Illuminate\Http\Request;

class WebServiceController extends Controller
{
    public function index() {
        $canales = Canal::all();
        header('Content-type: application/json');
        return json_encode($canales);
    }

    public function index2($day, $month, $year) {
        //$sugerencias = Sugerencia::where('created_at', '=', $date)->get();
        $sugerencias = Sugerencia::whereDay('created_at', '=', $day)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->get();
        header('Content-type: application/json');
        return json_encode($sugerencias);
    }
}
