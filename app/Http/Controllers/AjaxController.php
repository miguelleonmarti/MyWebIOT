<?php

namespace App\Http\Controllers;

use App\Canal;
use App\Charts\ChannelChart;
use App\DatoSensor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Sugerencia;

class AjaxController extends Controller
{
    public function getStats() {
        // number of 'canales' on the database
        $nCanales = Canal::count();
        // number of 'canales' on the database
        $nUsers = User::count();
        // number of 'sugerencias' on the database
        $nSugerencias = Sugerencia::count();
        // retrieving all the data on the database in order to figure out the bytes stored
        $result = DB::select('SHOW TABLE STATUS');
        // counter variable
        $nBytes = 0;
        // iterating the array and getting bytes of each element
        foreach ($result as $row) {
            $nBytes += $row->Data_length + $row->Index_length;
        }
        // dividing by 1024 (from bytes to kilobytes)
        $nBytes /= 1024;

        return response()->json(array(
            'nUsers' => $nUsers,
            'nCanales' => $nCanales,
            'nSugerencias' => $nSugerencias,
            'nBytes' => $nBytes), 200);
    }

    public function getCharts($id) {
        $x = [];
        $y = [];
        $chart1 = null;
        $chart2 = null;
        $index = 0;

        if (auth()->check()) {
            $id_user = auth()->user()->getAuthIdentifier();
            $canales = Canal::limit(2)->orderBy('created_at', 'desc')->where('id_user', '=', $id_user)->get();
        } else {
            $canales = Canal::limit(2)->orderBy('created_at', 'desc')->get();
        }

        if (count($canales) > 0) {
            // the user has at least one channel
            foreach ($canales as $canal) {
                $datosSensor = DatoSensor::where('id_canal', '=', $canal->id)->orderBy('created_at', 'DESC')->limit(10)->get();

                $datosSensor = $datosSensor->reverse();

                foreach ($datosSensor as $dato) {
                    $x[] = $dato->created_at->format('d/m/Y H:i:s');
                    $y[] = $dato->dato;
                }

                $chart = new ChannelChart();
                //$chart->labels($x);
                //$chart->displaylegend(true);
                $chart->dataset($canal->nombreCanal, 'line', $y)
               ->color("#53c1de")
                    ->backgroundcolor("#53c1de")
                    ->fill(false);

                if ($index == 0) {
                    $chart1 = $chart;
                } else {
                    $chart2 = $chart;
                }
                $index++;
                $x = [];
                $y = [];
            }
        }

        if($id == 1) {
            return $chart1->api();
        }
        return $chart2->api();
    }
}
