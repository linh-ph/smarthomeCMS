<?php

namespace App\Http\Controllers\Api;

use App\Features;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlightControllers extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/lights/data",
     *     tags={"Lights"},
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
        $dataTemp = Features::find(6);
        $tempSlug = $dataTemp->slug;

        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.'.$tempSlug.'/data');
        
        $data = $response->json();

        $date = Carbon::parse($data[0]['expiration'])->setTimezone('Asia/Ho_Chi_Minh');

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
     * @OA\Post(
     *     path="/api/lights/turn-on",
     *     tags={"Lights"},
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
    public function turnOn()
    {
        $AIO_KEY = env('AIO_KEY');
        $dataTemp = Features::find(6);
        $tempSlug = $dataTemp->slug;

        $response = Http::asMultipart()
        ->withHeaders([
            'X-AIO-Key' => 'aio_vUyi64X73Roekv6icLcHZxjC28qA',
        ])
        ->post('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.cse-bbc1-slash-feeds-slash-bk-iot-light/data', [
            'value' => 1,
        ]);
        
        $dataLight = $response->json();

        return response()->json([
            'status' => 'success',
            'data' => $dataLight,
        ]);
    }

        /**
     * @OA\Post(
     *     path="/api/lights/turn-off",
     *     tags={"Lights"},
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
    public function turnOff()
    {
        $AIO_KEY = env('AIO_KEY');
        $dataTemp = Features::find(6);
        $tempSlug = $dataTemp->slug;

        $response = Http::asMultipart()
        ->withHeaders([
            'X-AIO-Key' => 'aio_vUyi64X73Roekv6icLcHZxjC28qA',
        ])
        ->post('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.cse-bbc1-slash-feeds-slash-bk-iot-light/data', [
            'value' => 0,
        ]);
        
        $dataLight = $response->json();

        return response()->json([
            'status' => 'success',
            'data' => $dataLight,
        ]);
    }
}
