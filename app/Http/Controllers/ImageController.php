<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use App\Models\Product;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $product = session()->get('product');


        return view('products.uploadimage', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function storeImages(StoreImageRequest $request, $id)
    {



        $product = Product::find($id);

        if ($request->hasFile('picture1')) {

            $request->picture1->store('product', 'public');

            $picture1 = new Image([
                "content" => $request->picture1->hashName(),
                "product_id" =>  $id

            ]);
            $picture1->product()->associate($product);
            $picture1 -> save();

            if ($request->hasFile('picture2')) {

                $request->picture2->store('product', 'public');

                $picture2 = new Image([
                    "content" => $request->picture2->hashName(),
                    "product_id" =>  $id

                ]);
                $picture2->product()->associate($product);
                $picture2 -> save();

            }
            if ($request->hasFile('picture3')) {

                $request->picture3->store('product', 'public');

                $picture3 = new Image([
                    "content" => $request->picture3->hashName(),
                    "product_id" =>  $id

                ]);
                $picture3->product()->associate($product);
                $picture3 -> save();

            }

        }
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImageRequest  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
