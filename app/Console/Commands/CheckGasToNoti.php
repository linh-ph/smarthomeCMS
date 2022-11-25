<?php

namespace App\Console\Commands;

use App\Api\PushNotification;
use App\Features;
use App\NotificationLog;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckGasToNoti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gas:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiểm tra khí gas vượt ngưỡng';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $AIO_KEY = env('AIO_KEY');
        $dataTemp = Features::with('setting')->find(2);

        $tempSlug = $dataTemp->slug;
        $response = Http::withHeaders([
            'X-AIO-Key' => $AIO_KEY
        ])->get('https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.' . $tempSlug . '/data');
        $data = $response->json();

        $alterLevel = (int) $dataTemp->setting->muc_canh_bao;
        $gas = (int) $data[0]['value'];

        $title = 'Khí gas đang vượt ngưỡng cho phép';
        $body = 'Khí gas đang vượt ngưỡng cho phép, bạn cần tắt điện, kiểm tra lại bình gas và mở hết các cửa sổ xung quanh';
        $type = 2;
        $deviceUser = User::leftJoin('devices as d', function (JoinClause $join) {
            $join->on('users.id', '=', 'd.user_id')
                ->whereNull('d.deleted_at');
        })
            // ->select('fcm_token')
            ->where('users.id', 1)->select('fcm_token')->get()->toArray();
        // dd($deviceUser);
        $fcm_token = [];
        foreach ($deviceUser as $device) {
            $fcm_token[] = $device['fcm_token'];
        }

        if ($gas >= $alterLevel) {
            $notiTable = new NotificationLog();
            $notiTable->feature_id = 2;
            $notiTable->title = $title;
            $notiTable->message = $body;
            $notiTable->status;
            $notiTable->save();
            if ($notiTable) {
                try {
                    PushNotification::sendNotification($fcm_token, $title, $body, $type);
                } catch (Exception $e) {
                    return $e;
                }
            }
        }
    }
}
