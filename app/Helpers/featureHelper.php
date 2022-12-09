<?php

namespace App\Helpers;

use App\Features;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class featureHelper
{
    public static function getTemp()
    {
        $AIO_KEY = env('AIO_KEY');
        $dataTemp = Features::find(1);
        $tempSlug = $dataTemp->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.'.$tempSlug.'/data');
        
        $data = $response->json();
        return (int) $data[0]['value'];

    }
    public static function getGas()
    {
        $AIO_KEY = env('AIO_KEY');
        
        $dataTemp = Features::find(2);
        $tempSlug = $dataTemp->slug;

        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.'.$tempSlug.'/data');
        
        $data = $response->json();

        // $date = Carbon::parse($data[0]['expiration'])->setTimezone('Asia/Ho_Chi_Minh');

        // $data = [
        //     'temp' => (int) $data[0]['value'],
        //     'time' => $date->toDateTimeString()
        // ];
        return (int) $data[0]['value'];
    }
    // public static function get($id)
    // {
    //     if (empty($id)) {
    //         return;
    //     }
    // }
}
