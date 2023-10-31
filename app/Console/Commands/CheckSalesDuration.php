<?php

namespace App\Console\Commands;

use App\Models\Sale;
use App\Models\User;
use App\Notifications\SaleDurationWarning;
use Illuminate\Console\Command;

class CheckSalesDuration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-sales-duration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();
        $sales = Sale::whereRaw("DATEDIFF(?, created_at) BETWEEN duration - 3 AND duration", [$now])->get();
        $admins = User::where('role', 'admin')->get();
    
        foreach ($sales as $sale) {
            foreach ($admins as $admin) {
                $admin->notify(new SaleDurationWarning($sale));
            }
        }
    }
    
}
