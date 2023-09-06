<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckQuotedOrdersForRemoval extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-quoted-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if orders is quoted and delete old orders';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(): void
    {
        $timestamp = now()->subDays(30)->timestamp;
        $carbonDate = Carbon::createFromTimestamp($timestamp);
        $formattedDate = $carbonDate->format('Y-m-d H:i:s');

        Order::query()
            ->where('status', 'quoted')
            ->where('created_at', '<', $formattedDate)
            ->delete();
    }
}
