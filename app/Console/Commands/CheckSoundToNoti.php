<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckSoundToNoti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sound:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiểm tra tiếng ồn vượt ngưỡng';

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
        return 0;
    }
}
