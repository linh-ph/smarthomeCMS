<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->command->info('User table seeded!');
        $this->call(FeatureSeeder::class);
        $this->command->info('Feature table seeded!');

    }
}
