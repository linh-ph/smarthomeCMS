<?php

namespace App\Console\Commands;

use App\Api\PushNotification;
use App\Devices;
use App\Features;
use App\Helpers\featureHelper;
use App\Setting;
use Illuminate\Console\Command;

class sendNotiUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noti:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $gas = featureHelper::getGas();
        $temp = featureHelper::getTemp();
        // Features::find();
        $alterGas = Setting::where('feature_id', 2)->first();
        $alterTemp = Setting::where('feature_id', 1)->first();
        $mucBaoGas = 50;
        $mucBaoTemp = 30;
        if($alterGas){
            $mucBaoGas = $alterGas->muc_canh_bao;
        }
        if($alterTemp){
            $mucBaoTemp = $alterTemp->muc_canh_bao;
        }
        $fcm_token = Devices::select('fcm_token')->get();
        // dd($fcm_token);
        if($gas >= $mucBaoGas) {
            $fcm_tokens = Devices::select('fcm_token')->get()->toArray();
            // dd($fcm_token);
            foreach($fcm_tokens as $fcm){
                // dd($fcm['fcm_token']);
                $title = 'Khí gas đang vượt ngưỡng, hãy kiểm tra!!!';
                $body = 'Mở cửa sổ, đóng cầu giao điện xung quanh khu vực.';
                $type = 'Notification';
                PushNotification::sendNotification($fcm['fcm_token'], $title, $body, $type);
            }
            
        }
        if($temp >= $mucBaoTemp) {
            $fcm_tokens = Devices::select('fcm_token')->get()->toArray();
            // dd($fcm_token);
            foreach($fcm_tokens as $fcm){
                // dd($fcm['fcm_token']);
                $title = 'Nhiệt độ đang vượt ngưỡng!!!';
                $body = 'Mở máy lạnh cho mát đi';
                $type = 'Notification';
                PushNotification::sendNotification($fcm['fcm_token'], $title, $body, $type);
            }
        }
        $this->info('send notificaiton');
        return 'Send notification';
    }
}
