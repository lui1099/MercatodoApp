@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top: 50px">
        <h1>{{ trans('imageEdit.headers.selectImages') }}</h1>
        <h3>{{ trans('imageEdit.headers.product') }} {{ $product->name }}</h3>
        <h3>{{ trans('imageEdit.headers.product') }} {{ $product->brand }}</h3>

        <div class="col-sm-3">
            <div class="row-3" style="margin-top: 40px">
                <h2>{{ trans('imageEdit.headers.mainImage') }}</h2>
                <div class="card">
                    @if($product->image != null)
                        <div class="card">
                            <img src="{{ asset('storage/product/'.$product->image->content) }}" class="card-img-top" alt="...">
                            <button type="button" class="btn btn-danger"
                                    onclick="
                                        event.preventDefault();
                                        document.getElementById('delete-image-form-{{ $product->image->id }}').submit();
                                        return confirm(' {{ trans('imageEdit.confirm.delete1') }}{{ $product->name }}?')">
                                {{ trans('imageEdit.buttons.deleteImage') }}
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
                                <button class="btn btn-primary" type="submit">{{ trans('imageEdit.buttons.uploadMain') }}</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row-3" style="margin-top: 40px">
                <h2>{{ trans('imageEdit.headers.image2') }}</h2>
                @if($product->images->has(1))
                    <div class="card">
                        <img src="{{ asset('storage/product/'.$product->images[1]->content) }}" class="card-img-top" alt="...">
                        <button type="button" class="btn btn-danger"
                                onclick="
                                    event.preventDefault();
                                    document.getElementById('delete-image-form-{{ $product->images[1]->id }}').submit();
                                    return confirm('{{ trans('imageEdit.confirm.delete2') }} {{ $product->name }}?')">
                            {{ trans('imageEdit.buttons.deleteImage') }}
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
                            <button class="btn btn-primary" type="submit">{{ trans('imageEdit.buttons.upload2') }}</button>
                        </form>
                    </div>
                @endif
            </div>
            <div class="row-3" style="margin-top: 40px">
                <h2>{{ trans('imageEdit.headers.image3') }}</h2>
                @if($product->images->has(2))
                    <div class="card">
                        <img src="{{ asset('storage/product/'.$product->images[2]->content) }}" class="card-img-top" alt="...">
                        <button type="button" class="btn btn-danger"
                                onclick="
                                    event.preventDefault();
                                    document.getElementById('delete-image-form-{{ $product->images[2]->id }}').submit();
                                    return confirm('{{ trans('imageEdit.confirm.delete3') }} {{ $product->name }}?')">
                            {{ trans('imageEdit.buttons.deleteImage') }}
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
                            <button class="btn btn-primary" type="submit">{{ trans('imageEdit.buttons.upload3') }}</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
