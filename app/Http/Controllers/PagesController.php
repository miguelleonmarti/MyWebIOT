<?php

namespace App\Http\Controllers;

use App\Canal;
use App\Charts\ChannelChart;
use App\DatoSensor;
use App\Sugerencia;
use App\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        $x = [];
        $y = [];
        $chart1 = null;
        $chart2 = null;
        $index = 0;
        $api = url('/getCharts');

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
                $chart->labels($x)->load($api);
                //$chart->displaylegend(true);
                //$chart->dataset($canal->nombreCanal, 'line', $y)
                //->color("#53c1de")
                //->backgroundcolor("#53c1de")
                //->fill(false); // true -> filled

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

        $canales = Canal::all();
        $sugerencias = Sugerencia::all();
        $usuarios = User::where('email', '!=', 'admin@admin.com')->get();

        return view('index', ['chart1' => $chart1, 'chart2' => $chart2, 'canales' => $canales, 'sugerencias' => $sugerencias, 'usuarios' => $usuarios]);
    }

    public function support()
    {
        return view('support');
    }

    public function channelList()
    {
        if (auth()->check()) {
            $id_user = auth()->user()->getAuthIdentifier();
            $canales = Canal::where('id_user', '=', $id_user)->get();
        } else {
            $canales = Canal::get();
        }


        return view('channelList')
            ->with('canales', $canales);
    }

    public function newChannel()
    {
        return view('newChannel');
    }

    public function create(Request $request)
    {

        $id_user = auth()->user()->getAuthIdentifier(); //TODO: IMPORTANTE

        $this->validate(request(), [
            'nombreCanal' => 'required',
            'descripcion' => 'required',
            'longitud' => 'required|numeric',
            'latitud' => 'required|numeric',
            'nombreSensor' => 'required'
        ]);

        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $url = substr(str_shuffle($chars), 0, 5);

        Canal::create([
            'id_user' => $id_user,
            'nombreCanal' => $request->nombreCanal,
            'url' => $url,
            'descripcion' => $request->descripcion,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'nombreSensor' => $request->nombreSensor
        ]);

        return redirect()->to('/channelList');
    }

    public function destroy($id)
    {
        Canal::destroy($id);
        return redirect()->to('/');
    }

    public function destroyUser($id)
    {
        User::destroy($id);
        return redirect()->to('/');
    }

    public function destroySuggestion($id)
    {
        Sugerencia::destroy($id);
        return redirect()->to('/');
    }

    public function update(Request $request)
    {
        $this->validate(request(), [
            'url' => 'required',
            'dato' => 'required'
        ]);

        $canal = Canal::where('url', '=', $request->url)->first();

        DatoSensor::create([
            'id_canal' => $canal->id,
            'dato' => $request->dato
        ]);

        echo "Data stored successfully";
    }

    public function suggestion(Request $request) {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Sugerencia::create([
            'name' => $request->name,
            'message' => $request->message,
            'email' => $request->email
        ]);

        return redirect()->to('/login');
    }

    public function webService() {
        return view('webService');
    }
}
