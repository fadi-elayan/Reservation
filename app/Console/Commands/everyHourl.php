<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class everyHourl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourl:update';

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
     * @return mixed
     */
    public function handle()
    {

            DB::table('reservation')
                ->where('to' ,'<' ,Carbon::now()->toDate())
                ->delete();
            DB::table('reservation')
                ->where('to' ,'=' ,Carbon::now()->toDate())
                ->where('time_to' ,'<=' ,Carbon::now()->toDateTime())
                ->delete();
    }
}
