<?php

use App\Features;
use App\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('features')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::transaction(function () {
            $addFe = Features::create([
                'name'=> 'Nhiệt Độ',
                'slug'=> 'cse-bbc-slash-feeds-slash-bk-iot-temp-humid',
                'min'=> 0,
                'max'=> 100,
            ]);
            if($addFe) {
                Setting::create([
                    'feature_id' => $addFe->id,
                    'muc_canh_bao' => 30,
                    'trang_thai' => 1,
                ]);
            }
    
            $addFe = Features::create([
                'name'=> 'Khí Gas',
                'slug'=> 'cse-bbc1-slash-feeds-slash-bk-iot-gas',
                'min'=> 0,
                'max'=> 100,
            ]);
            if($addFe) {
                Setting::create([
                    'feature_id' => $addFe->id,
                    'muc_canh_bao' => 60,
                    'trang_thai' => 1,
                ]);
            }

            $addFe = Features::create([
                'name'=> 'Tiếng Ồn',
                'slug'=> 'cse-bbc1-slash-feeds-slash-bk-iot-sound',
                'min'=> 0,
                'max'=> 100,
            ]);
            if($addFe) {
                Setting::create([
                    'feature_id' => $addFe->id,
                    'muc_canh_bao' => 60,
                    'trang_thai' => 1,
                ]);
            }

            $addFe = Features::create([
                'name'=> 'Bóng đèn',
                'slug'=> 'cse-bbc1-slash-feeds-slash-bk-iot-sound',
                'min'=> 0,
                'max'=> 1,
            ]);

            $addFe = Features::create([
                'name'=> 'Lượng Mưa',
                'slug'=> 'rain',
                'min'=> 0,
                'max'=> 100,
            ]);
            if($addFe) {
                Setting::create([
                    'feature_id' => $addFe->id,
                    'muc_canh_bao' => 60,
                    'trang_thai' => 1,
                ]);
            }

            $addFe = Features::create([
                'name'=> 'Đèn',
                'slug'=> 'cse-bbc1-slash-feeds-slash-bk-iot-light',
                'min'=> 0,
                'max'=> 1023,
            ]);
        });
    }
}
