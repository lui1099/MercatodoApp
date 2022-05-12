<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Jobs\NotifyUserOfCompletedExport;
use App\Jobs\NotifyUserOfCompletedImport;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Types\False_;
use Maatwebsite\Excel\Concerns\Importable;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $products = Product::paginate();

        return view('products.productslist', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        return view('products.createproduct');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create2()
    {
        return view('products.createproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {


            $product = new Product([
                "name" => $request->input('name'),
                "brand" => $request->input('brand'),
                "category" => $request->input('category'),
                "price" => $request->input('price'),
                "description" => $request->input('description'),
                "stock" => $request->input('stock'),
                "available" => $request->input('available'),


            ]);
            $product->save();

        return redirect()->route('images.create')->with(['product' => $product] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {

        return view('products.showProduct', compact('product') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('products.productEdit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->except('isActive'));

        if ($request->has('isActive'))
        {
            $product->update(['isActive' => true]);
        }
        else
        {
            $product->update(['isActive' => false]);
        }

        return redirect(route('products.show', ['product' => $product] ));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect(route('products.adminlist'));
    }

    protected function search(Request $request)
    {
        $search = $request->search;
        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();

        $products2 = Product::when($search, function ($query) use ($search) {
            $query->where('brand', 'like', '%' . $search . '%');
        })->get();

        foreach ($products2 as $product)
        {
            if (! $products->contains($product))
            {
                $products->push($product);
            }
        }

        $products3 = Product::when($search, function ($query) use ($search) {
            $query->where('description', 'like', '%' . $search . '%');
        })->get();

        foreach ($products3 as $product)
        {
            if (! $products->contains($product))
            {
                $products->push($product);
            }
        }


        return view('products.productslist', compact('products'));
    }

    protected function food()
    {

        $products = Product::whereIn('category', ['food'])->get();

        return view('products.productslist', compact('products'));
    }

    protected function cleaning()
    {

        $products = Product::whereIn('category', ['cleaning'])->get();

        return view('products.productslist', compact('products'));
    }

    protected function health()
    {

        $products = Product::whereIn('category', ['health&pc'])->get();

        return view('products.productslist', compact('products'));
    }

    public function import(Request $request)
    {



        $import = new ProductsImport();
        try {
        $import->queue($request->file('sheet'))->chain([new NotifyUserOfCompletedImport(auth()->user())]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
        }


//        $import->import($request->file('sheet'));
////
//        dd($failures);




       return redirect()->route('products.importForm')->with('message', trans('importProducts.messages.queue'));

    }

    public function importForm()
    {

        return view('products.importProduct');
    }

    public function exportView()
    {

        return view('products.exportView');
    }

    public function export(Request $request)
    {

        $category = $request->category;

//        (new ProductsExport($category))->queue('Products.xlsx')->chain([
//            new NotifyUserOfCompletedExport(auth()->user())]);

        return Excel::download(new ProductsExport($category), 'invoices.xlsx');

        return redirect()->route('products.exportView')->with('message', trans('exportView.messages.queue'));


    }

}
