<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\NoReport;
use App\FuelShop;

class NoReportCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'no_report:cron';

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
       // \Log::info("Cron is working fine!");

       //  $this->info('Demo:Cron Cummand Run successfully!');
        
        $fuel_shops = FuelShop::where('show_status',1)->where('shop_status',1)->get();
        foreach ($fuel_shops as $key => $value) {
            $no_report = NoReport::create([
                'shop_id'=>$value->id
            ]);
        }

        \Mail::to('linndeveloper3@gmail.com')->send(new \App\Mail\NoReportMail());

        $this->info('No Report Shop Create successfully');
    }


}
