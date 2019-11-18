<?php

namespace App\Http\Controllers;

use App\Canal;
use App\Charts\ChannelChart;
use App\DatoSensor;
use App\Producto;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $canal = Canal::where('id', '=', $id)->first();

        $x = [];
        $api = url('/refresh');
        //$y = [];

        $datosSensor = DatoSensor::where('id_canal', '=', $canal->id)->orderBy('created_at', 'DESC')->limit(10)->get();

        $datosSensor = $datosSensor->reverse();

        foreach ($datosSensor as $dato) {
            $x[] = $dato->created_at->format('d/m/Y H:i:s');
            //$y[] = $dato->dato;
        }

        $chart = new ChannelChart();
        $chart->labels($x)->load($api);
        //$chart->displaylegend(false);
        //$chart->dataset('Vertical Axys', 'line', $y)
            //->color("#53c1de")
            //->backgroundcolor("#53c1de")
            //->fill(false); // true -> filled
        return view('chart', ['chart' => $chart, 'nombreCanal' => $canal->nombreCanal]);
    }

    public function refresh($id) {
        $canal = Canal::where('id', '=', $id)->first();

        //$x = [];
        $y = [];

        $datosSensor = DatoSensor::where('id_canal', '=', $canal->id)->orderBy('created_at', 'DESC')->limit(10)->get();

        $datosSensor = $datosSensor->reverse();

        foreach ($datosSensor as $dato) {
            //$x[] = $dato->created_at->format('d/m/Y H:i:s');
            $y[] = $dato->dato;
        }

        $chart = new ChannelChart();
        //$chart->labels($x);
        $chart->displaylegend(false);
        $chart->dataset('Vertical Axys', 'line', $y)
            ->color("#53c1de")
            ->backgroundcolor("#53c1de")
            ->fill(false); // true -> filled
        return $chart->api();
    }

    public function productUpdate($id) {
        $producto = Producto::all()->where('id', '=', $id)->first();
        return view('producto')->with('producto', $producto);
    }

    public function update(Request $request, $id) {
        $this->validate(request(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric'
        ]);

        Producto::where('id', '=', $id)->update(['nombre' => $request->nombre, 'descripcion' => $request->descripcion, 'precio' => $request->precio]);
        return redirect('/');
    }
}
