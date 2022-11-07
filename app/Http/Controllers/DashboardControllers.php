<?php

namespace App\Http\Controllers;

use App\Features;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardControllers extends Controller
{
    public function callApiDataTemp() {

        $dataTemp = Features::find(1);
        $tempSlug = $dataTemp->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_ZwDf70T7nbxuiqpGGw5GQuru1k2D'
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.'.$tempSlug.'/data');
        
        $data = $response->json();
        $value_temp = (int) $data[0]['value'];

        //GAS
        $dataGas = Features::find(2);
        $gasSlug = $dataGas->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_ZwDf70T7nbxuiqpGGw5GQuru1k2D'
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.'.$gasSlug.'/data');
        
        $dataGas = $response->json();
        $valueGas = (int) $dataGas[0]['value'];
        ///

        /// SOUND
        $dataSound = Features::find(3);
        $soundSlug = $dataSound->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_ZwDf70T7nbxuiqpGGw5GQuru1k2D'
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.'.$soundSlug.'/data');
        
        $dataSound = $response->json();
        $valueSound = (int) $dataSound[0]['value'];
        ///
        $dataArr = [];

        for($i = 0; $i < 7; $i++){
            array_push($dataArr,(int) $data[$i]['value']);
        }
        // dd($dataArr);
        $expiration = $data[0]['expiration'];
        return view('home', compact('value_temp', 'dataArr', 'valueGas', 'valueSound'));
    }
}
