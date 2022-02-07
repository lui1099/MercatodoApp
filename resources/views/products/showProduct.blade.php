@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-8">

                <div>
                    <div class="m-4">
                        @if (Auth::user()->role == 'admin')
                            <a role="button" href="{{route('products.edit', $product)}}" class="btn btn-primary">Editar Producto</a>
                        @endif
                        <a role="button" href="{{route('products.index', $product)}}" class="btn btn-dark">Volver</a>
                    </div>
                    <div style="margin-top: 30px">
                        @if($product->isActive == 0)
                            <h1 style="color: orangered">INHABILITADO</h1>
                        @endif
                        <h1 style="text-shadow: #4f5050 ">{{ $product->name }}</h1>
                        <h3>Marca: {{ $product->brand }}</h3>
                        <h3>Id: {{ $product->id }}</h3>
                        <div class="row">
                            <div class="col-3">
                                <h4>Precio por unidad:</h4>
                            </div>
                            <div class="col-3">
                                <h3 style="color: red">COP {{ $product->price }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-4" style="margin-top: 200px">
                    <h4>{{ $product->description }}</h4>
                </div>
        </div>


    </div>
    <div class="container" style="margin-top: 50px">
        <h3>Fotos del producto:</h3>

        <div class="row my-4">
            <div class="col-3">
                <div class="card">
                    @if($product->image != null)
                        <img src="{{ asset('storage/product/'.$product->image->content) }}" class="card-img-top" alt="...">
                    @else
                        <img src="{{ asset('storage/product/nophoto.jpg') }}" class="card-img-top" alt="...">
                    @endif
                </div>
            </div>
            <div class="col-3">
                @if($product->images->has(1))
                    <div class="card">
                        <img src="{{ asset('storage/product/'.$product->images[1]->content) }}" class="card-img-top" alt="...">
                    </div>
                @endif
            </div>
            <div class="col-3">
                @if($product->images->has(2))
                    <div class="card">
                        <img src="{{ asset('storage/product/'.$product->images[2]->content) }}" class="card-img-top" alt="...">
                    </div>
                @endif
            </div>

        </div>
    </div>




@endsection
