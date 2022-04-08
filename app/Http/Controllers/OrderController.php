<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Request\CreateSessionRequest;
use App\Services\WebcheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $orders = Order::where('user_id', $userId)->orderBy('created_at')->paginate(50);

        return view('orders.ordersIndex', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $cartContent = $order->cartItems;


        return view('orders.showOrder', compact('order', 'cartContent'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function refresh($order)
    {
        $id = $order;
        $order = Order::findOrFail($id);

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
        elseif ($response['status']['status'] == 'REJECTED') {
            $order->update(['status' => 'rejected']);

            $cartContent = $order->cartItems;
            foreach ($cartContent as $cartItem) {
                $product = Product::findOrFail($cartItem->product_id);
                $newAvailable = ($product->available)+($cartItem->qty);
                $product->update(['available' => $newAvailable]);
            }
        }

        return redirect()->route('orders.show', ['order' => $order]);
    }

    public function retry($order)
    {
        $id = $order;
        $order = Order::findOrFail($id);

        $total = $order->total;
        $data =   [
            'payment' => [
                'reference' => $order->reference,
                'description' => 'pago MercatodoApp',
                'amount' => [
                    'currency' => 'COP',
                    'total' => $total
                ],
            ],
            'returnUrl' => route('home'),
            'expiration' => date('c', strtotime('+1 hour'))];


        $data = ((new CreateSessionRequest($data)))->toArray();

        $response = (new WebcheckoutService())->createSession($data);

        $requestId = $response['requestId'];

        $order->update(['requestId' => $requestId]);
        $order->update(['status' => 'pending']);
        $processUrl = $response['processUrl'];

        return redirect()->away($processUrl);



    }
}
