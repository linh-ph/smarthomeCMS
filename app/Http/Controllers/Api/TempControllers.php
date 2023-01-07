<?php

namespace App\Http\Controllers\Api;

use App\Features;
use App\Http\Controllers\Controller;
use App\Repositories\FeaturesRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TempControllers extends Controller
{
/**
 * @OA\Get(
 *     path="/api/temp/data",
 *     tags={"Temp"},
 *     @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Error server",
 *      )
* )
*/    
    public function getData()
    {
        $AIO_KEY = env('AIO_KEY');
        $dataTemp = Features::find(1);
        $tempSlug = $dataTemp->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
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

    /**
 * @OA\Get(
 *     path="/api/temp/chart",
 *     tags={"Temp"},
 *     @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Error server",
 *      )
* )
*/    
    public function getChart()
    {
        $AIO_KEY = env('AIO_KEY');
        $dataTemp = Features::find(1);
        $tempSlug = $dataTemp->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.'.$tempSlug.'/data');
        
        $dataCollect = collect($response->json())->take(8);

        $date = timezone_identifiers_list();

        $dataJson = [];
        foreach ($dataCollect as $data) {
            $date = Carbon::parse($data['expiration'])->setTimezone('Asia/Ho_Chi_Minh');
            $arr = [
                'temp'=> $data['value'],
                'time'=> $date
            ];
            array_push($dataJson, $arr);
        };
        return response()->json([
            'status' => 'success',
            'data' => $dataJson,
        ]);
    }

}
