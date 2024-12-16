<?php

namespace App\Jobs;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoUpdateDeliveryStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orders = Order::where('status', 'delivered')
        ->where('received', false)
        ->where('updated_at', '<=', Carbon::now()->subDays(2)) // Cập nhật sau 2 ngày
        ->get();

    foreach ($orders as $order) {
        $order->received = true;
        $order->status = 'completed'; // Chuyển trạng thái sang completed
        $order->save();
    }
    }
}
