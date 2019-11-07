<?php

namespace App\Http\Controllers;

use App\Canal;
use App\Charts\ChannelChart;
use App\DatoSensor;

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
        $y = [];

        $datosSensor = DatoSensor::all()->where('id_canal', '=', $canal->id);

        foreach ($datosSensor as $dato) {
            $x[] = $dato->created_at->format('d/m/Y H:i:s');
            $y[] = $dato->dato;
        }

        $chart = new ChannelChart();
        $chart->labels($x);
        $chart->displaylegend(false);
        $chart->dataset('Vertical Axys', 'line', $y)
            ->color("#53c1de")
            ->backgroundcolor("#53c1de")
            ->fill(false); // true -> filled
        return view('chart', ['chart' => $chart, 'nombreCanal' => $canal->nombreCanal]);
    }
}
