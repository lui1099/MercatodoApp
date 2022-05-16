<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Request\GetInformationRequest;
use App\Request\CreateSessionRequest;
use App\Services\WebcheckoutService;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartContent = Cart::content();

        $total = 0;
        foreach ($cartContent as $cartItem)
            $total = $total+$cartItem->qty*$cartItem->price;


        return view('cart', compact('cartContent', 'total'));
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


    public function store(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $newAvailable = ($product->available)-($request->input('quantity'));
        if ($newAvailable < 0){

            return redirect()->route('products.show', ['product' => $product])->with('message', trans('showProduct.messages.notAvailable'));
        }
        else {
            $product->update(['available' => $newAvailable]);
            Cart::add($product->id, $product->name, $request->input('quantity'), $product->price);

            return redirect()->route('products.show', ['product' => $product])->with('message', trans('showProduct.messages.success'));
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Cart::destroy();

        return redirect(route('cart.index'));
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteItem(Request $request)
    {

        Cart::remove($request->rowId);

        return redirect(route('cart.index'));
    }


    public function goToPay(Request $request)
    {
        $referenceReference = Order::latest()->first()->reference;
        $reference = $referenceReference + 1;


        $total = $request->total;
        $data =   [
        'payment' => [
            'reference' => $reference,
            'description' => 'pago MercatodoApp',
            'amount' => [
                'currency' => 'COP',
                'total' => $total
                ],
            ],
        'returnUrl' => route('orders.refreshAfterCheckout', $reference),
        'expiration' => date('c', strtotime('+1 hour'))
        ];


        $data = ((new CreateSessionRequest($data)))->toArray();
//        dd($data);
        $response = (new WebcheckoutService())->createSession($data);

        $requestId = $response['requestId'];
        $processUrl = $response['processUrl'];

        $order = new Order([
            'reference' => $reference,
            'requestId' => $requestId,
            'user_id' => auth()->user()->id,
            'total' => $total,
        ]);
        $order->save();

        $orderId = $order->id;

        $cartContent = Cart::content();

        foreach ($cartContent as $cartItem) {

            $product = Product::findOrFail($cartItem->id);
            $newCartItem = new CartItem([
                "name" => $cartItem->name,
                "qty" => $cartItem->qty,
                "pricePerUnit" => $cartItem->price,
                "pricePerItem" => $cartItem->price*$cartItem->qty,
                "order_id" => $orderId,
                "product_id" => $cartItem->id,
                "category" => $product->category,
             ]);

            $newCartItem->order()->associate($order);
            $newCartItem->save();
        }



        Cart::destroy();


        return redirect()->away($processUrl);
    }



}

