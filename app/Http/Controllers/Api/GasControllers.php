<?php

namespace App\Http\Controllers\Api;

use App\Features;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GasControllers extends Controller
{
    public function getData()
    {
        $dataTemp = Features::find(2);
        $tempSlug = $dataTemp->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_ZwDf70T7nbxuiqpGGw5GQuru1k2D'
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.'.$tempSlug.'/data');
        
        $data = $response->json();
        // dd($data);
        // $value_temp = (int) $data[0]['value'];
        // $date = timezone_identifiers_list();
        $date = Carbon::parse($data[0]['expiration'])->setTimezone('Asia/Ho_Chi_Minh');
        // dd($date);
        $data = [
            'temp' => (int) $data[0]['value'],
            'time' => $date->toDateTimeString()
        ];
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
