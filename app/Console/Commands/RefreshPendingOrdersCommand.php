<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use App\Services\WebcheckoutService;
use Illuminate\Console\Command;

class RefreshPendingOrdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshOrder:pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command refreshes the status of pending orders';

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
        $orders = Order::where('status', 'pending');
        foreach ($orders as $order)
        {
            $response = (new WebcheckoutService())->getInformation($order->requestId);
            if ($response['status']['status'] == 'APPROVED') {
                $order->update(['status' => 'approved']);

                $cartContent = $order->cartItems;
                foreach ($cartContent as $cartItem) {
                    $product = Product::findOrFail($cartItem->product_id);
                    $newStock = ($product->stock)-($cartItem->qty);
                    $product->update(['stock' => $newStock]);
                }

            }
        }
        return 0;
    }
}
