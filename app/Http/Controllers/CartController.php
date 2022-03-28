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
//        dd($cartContent);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        Cart::add($product->id, $product->name, $request->input('quantity'), $product->price);

        return redirect()->route('products.show', ['product' => $product])->with('message', 'producto agregado'/*trans('showProduct.messages.success')*/);
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
//        dd($request);
        Cart::remove($request->rowId);

        return redirect(route('cart.index'));
    }


    public function goToPay(Request $request)
    {
        $total = $request->total;
        $data =   [
        'payment' => [
            'reference' => /*base64_encode(Str::random(8))*/ '000001',
            'description' => 'pago MercatodoApp',
            'amount' => [
                'currency' => 'COP',
                'total' => $total
            ],
        ],
        'returnUrl' => route('home'),
        'expiration' => date('c', strtotime('+1 hour'))];


        $data = ((new CreateSessionRequest($data)))->toArray();
//        dd($data);
        $response = (new WebcheckoutService())->createSession($data);

        $requestId = $response['requestId'];
        $processUrl = $response['processUrl'];

        $order = new Order([


        ]);

        $cartContent = Cart::content();
        foreach ($cartContent as $cartItem)
            $newCartItem = new CartItem([
                "name" => $cartItem->name,
                "qty" => $cartItem->qty,
                "pricePerUnit" => $cartItem->price,
                "pricePerItem" => $cartItem->price*$cartItem->qty
            ]);
            $newCartItem->save();




        return redirect()->away($processUrl);
    }



}

