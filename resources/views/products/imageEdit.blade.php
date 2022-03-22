@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top: 50px">
        <h1>Seleccione las imagenes del producto</h1>
        <h3> Producto: {{ $product->name }}</h3>
        <h3> Id: {{ $product->id }}</h3>
        <h3> Marca: {{ $product->brand }}</h3>

        <div class="col-sm-3">
            <div class="row-3" style="margin-top: 40px">
                <h2>Imagen principal</h2>
                <div class="card">
                    @if($product->image != null)
                        <div class="card">
                            <img src="{{ asset('storage/product/'.$product->image->content) }}" class="card-img-top" alt="...">
                            <button type="button" class="btn btn-danger"
                                    onclick="
                                        event.preventDefault();
                                        document.getElementById('delete-image-form-{{ $product->image->id }}').submit();
                                        return confirm('Esta seguro que quiere eliminar la imagen 2 del producto {{ $product->name }}?')">
                                Eliminar Imagen
                            </button>
                            <form id="delete-image-form-{{ $product->image->id }}" action="{{ route('images.destroy', $product->image, $product) }}" method="POST" style="display: none">
                                @csrf
                                @method("DELETE")

                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            <form id="image_form" action="{{ route('store.new.images', $product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="file" name="picture1">
                                </div>
                                <button class="btn btn-primary" type="submit">Subir imagen principal</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row-3" style="margin-top: 40px">
                <h2>Imagen 2</h2>
                @if($product->images->has(1))
                    <div class="card">
                        <img src="{{ asset('storage/product/'.$product->images[1]->content) }}" class="card-img-top" alt="...">
                        <button type="button" class="btn btn-danger"
                                onclick="
                                    event.preventDefault();
                                    document.getElementById('delete-image-form-{{ $product->images[1]->id }}').submit();
                                    return confirm('Esta seguro que quiere eliminar la imagen 2 del producto {{ $product->name }}?')">
                            Eliminar Imagen
                        </button>
                        <form id="delete-image-form-{{ $product->images[1]->id }}" action="{{ route('images.destroy', $product->images[1], $product) }}" method="POST" style="display: none">
                            @csrf
                            @method("DELETE")

                        </form>
                    </div>
                @else
                    <div class="card-body">
                        <form id="image_form" action="{{ route('store.new.images', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" name="picture2">
                            </div>
                            <button class="btn btn-primary" type="submit">Subir imagen 2</button>
                        </form>
                    </div>
                @endif
            </div>
            <div class="row-3" style="margin-top: 40px">
                <h2>Imagen 3</h2>
                @if($product->images->has(2))
                    <div class="card">
                        <img src="{{ asset('storage/product/'.$product->images[2]->content) }}" class="card-img-top" alt="...">
                        <button type="button" class="btn btn-danger"
                                onclick="
                                    event.preventDefault();
                                    document.getElementById('delete-image-form-{{ $product->images[2]->id }}').submit();
                                    return confirm('Esta seguro que quiere eliminar la imagen 3 del producto {{ $product->name }}?')">
                            Eliminar Imagen
                        </button>
                        <form id="delete-image-form-{{ $product->images[2]->id }}" action="{{ route('images.destroy', $product->images[2], $product) }}" method="POST" style="display: none">
                            @csrf
                            @method("DELETE")

                        </form>
                    </div>
                @else
                    <div class="card-body">
                        <form id="image_form" action="{{ route('store.new.images', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" name="picture3">
                            </div>
                            <button class="btn btn-primary" type="submit">Subir imagen 3</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
