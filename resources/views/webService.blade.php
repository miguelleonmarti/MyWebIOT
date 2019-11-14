@extends('common')

@section('title', 'Web Service')

@section('body')

<?php
    $day = "14";
    $month = "11";
    $year = "2019";

    $request = "http://laboratorio.test/webService2/" . $day . "/" . $month . "/" . $year;
    $http = curl_init($request);
    curl_setopt($http, CURLOPT_HEADER, false);
    curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($http);
    $status_code = curl_getinfo($http, CURLINFO_HTTP_CODE);
    curl_close($http);
    if ($status_code == 200) {
        $sugerencias = json_decode($response);

        echo '<table><tr><th>Nombre</th><th>Email</th><th>Mensaje</th></tr>';

        if (json_last_error() == JSON_ERROR_NONE) {
            foreach ($sugerencias as $sugerencia) {
                echo '<tr>';
                echo '<td>' . $sugerencia->name . '</td>';
                echo '<td>' . $sugerencia->email . '</td>';
                echo '<td>' . $sugerencia->message . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    } else {
        echo "Falló la llamada al Web Service. Error: ". $status_code;
    }

?>

@endsection
