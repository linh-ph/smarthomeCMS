<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $addAdmin = User::create(
        	['name'=>'admin','password'=>Hash::make('admin'),'name'=>'Minh Tân', 'email' => 'tanminhvo12340@gmail.com']
        );
    }
}
