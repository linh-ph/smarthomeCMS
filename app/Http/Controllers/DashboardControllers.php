<?php

namespace App\Http\Controllers;

use App\Api\PushNotification;
use App\Features;
use App\User;
use Exception;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\TryCatch;

class DashboardControllers extends Controller
{

    public function callApiDataTemp()
    {
        /////////////
        $AIO_KEY = env('AIO_KEY');
        // dd($AIO_KEY);
        $dataTemp = Features::find(1);
        $tempSlug = $dataTemp->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.' . $tempSlug . '/data');

        $data = $response->json();
        $value_temp = (int) $data[0]['value'];

        //GAS
        $dataGas = Features::find(2);
        $gasSlug = $dataGas->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.' . $gasSlug . '/data');

        $dataGas = $response->json();
        $valueGas = (int) $dataGas[0]['value'];
        ///

        /// SOUND
        $dataSound = Features::find(3);
        $soundSlug = $dataSound->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.' . $soundSlug . '/data');

        $dataSound = $response->json();
        // dd($dataSound);
        $valueSound = (int) $dataSound[0]['value'];
        ///
        // $dataArr = [];

        // for($i = 0; $i < 7; $i++){
        //     array_push($dataArr,(int) $data[$i]['value']);
        // }
        // // $expiration = $data[0]['expiration'];
        /// LIGHT
        $dataLight = Features::find(6);
        $lightSlug = $dataLight->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.' . $lightSlug . '/data');

        $dataLight = $response->json();
        // dd($dataLight);
        $valueLight = (int) $dataLight[0]['value'];
        ///
        return view('home', compact('value_temp', 'valueGas', 'valueSound', 'AIO_KEY', 'valueLight'));
    }
}
