<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Arr;

class SalesReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $from;
    public $to;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($from, $to, User $user)
    {
        $this->from = $from;

        $this->to = $to;

        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::query()->where('status', 'approved')->whereBetween('created_at', [$this->from,$this->to])->get();


        $food = 0;
        $partialFood = 0;
        $healthpc = 0;
        $partialHealthpc = 0;
        $cleaning = 0;
        $partialCleaning = 0;

        $orders = collect($orders);


        foreach ($orders as $order) {

            $items = $order->cartItems()->get();

            foreach ($items as $item) {

                if ($item->category == 'food') {
                    $food = $food + $item->pricePerItem;
                    $partialFood = $partialFood + $item->pricePerItem;
                } elseif ($item->category == 'health&pc') {
                    $healthpc = $healthpc + $item->pricePerItem;
                    $partialHealthpc = $partialHealthpc + $item->pricePerItem;
                } elseif ($item->category == 'cleaning') {
                    $cleaning = $cleaning + $item->pricePerItem;
                    $partialCleaning= $partialCleaning + $item->pricePerItem;
                }

            }
            $order->setAttribute('food', $partialFood);
            $partialFood = 0;

            $order->setAttribute('healthpc', $partialHealthpc);
            $partialHealthpc = 0;

            $order->setAttribute('cleaning', $partialCleaning);
            $partialCleaning = 0;

        }


        $data = [$food, $healthpc, $cleaning];

        $to = $this->to;
        $from = $this->from;

        $html = view('reports.pieChart', compact('data', 'to', 'from', 'orders'))->render();

        $result = uniqid();
        $path = $result;

        $tempFile = tmpfile();
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];

        file_put_contents($tempFilePath, $html);
        $tempFileObject = new File($tempFilePath);

        Storage::put($path.'.blade.php', $tempFileObject );
        file_put_contents('storage/app/views/'.$path.'.blade.php', $html);


        return dispatch(new NotifyUserOfCompletedReport($this->user, $path));

    }
}
