@extends('layouts.app')

@section('content')

    <div class="container">
        <a role="button" href="{{route('products.show', $product)}}" class="btn btn-dark">Volver</a>
    </div>
    <div class="container" style="margin-top: 50px">
        <form id="product_form" action="{{ route('products.update', $product->id) }}" method="POST">

            @csrf
            @method('PATCH')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="name">{{ trans('createproduct.fields.name') }}</label>
                <input name="name" value="{{ old('name') }} @isset($product) {{ $product->name }} @endisset" type="text" required>
            </div>
            <div class="mb-3">
                <label for="brand">{{ trans('createproduct.fields.brand') }}</label>
                <input name="brand" value="{{ old('brand') }} @isset($product) {{ $product->brand }} @endisset" type="text" required>
            </div>
            <div class="mb-3">
                <label for="price">{{ trans('createproduct.fields.price') }}</label>
                <input name="price" type="text" value="{{ old('price') }} @isset($product) {{ $product->price }} @endisset" required>
            </div>
            <div class="mb-3">
                <label for="category">{{ trans('createproduct.fields.category') }}</label>
                <select name="category" id="category">
                    <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>{{ trans('createproduct.cascade.food') }}</option>
                    <option value="health&pc" {{ old('category') == 'health&pc' ? 'selected' : '' }}>{{ trans('createproduct.cascade.health&pc') }}</option>
                    <option value="cleaning" {{ old('category') == 'cleaning' ? 'selected' : '' }}>{{ trans('createproduct.cascade.cleaning') }}</option>

                </select>
            </div>
            <div class="mb-3">
                <label for="description" style="vertical-align: center">{{ trans('createproduct.fields.description') }}</label>
                <textarea style="vertical-align: middle" cols="90" name="description" id="description" type="text"  >{{ old('description') }} @isset($product) {{ $product->description }} @endisset</textarea>
            </div>
            <div class="row my-4">
                <div class="col-3">
                    <h2>{{ trans('imageEdit.headers.mainImage') }}</h2>
                    <div class="card">
                        @if($product->image != null)
                            <img src="{{ asset('storage/product/'.$product->image->content) }}" class="card-img-top" alt="...">
                        @else
                            <img src="{{ asset('storage/product/nophoto.jpg') }}" class="card-img-top" alt="...">
                        @endif
                    </div>
                </div>
                <div class="col-3">
                    <h2>{{ trans('imageEdit.headers.image2') }}</h2>
                    @if($product->images->has(1))
                        <div class="card">
                            <img src="{{ asset('storage/product/'.$product->images[1]->content) }}" class="card-img-top" alt="...">
                        </div>

                    @endif
                </div>
                <div class="col-3">
                    <h2>{{ trans('imageEdit.headers.image3') }}</h2>
                    @if($product->images->has(2))
                        <div class="card">
                            <img src="{{ asset('storage/product/'.$product->images[2]->content) }}" class="card-img-top" alt="...">
                        </div>
                    @endif
                </div>
                <div class="mb-3" style="margin-top: 5px">
                    <a role="button" href="{{route('edit.images', $product)}}" class="btn btn-dark">{{ trans('productEdit.labels.editImages') }}</a>
                </div>

            </div>

            <div class="mb-3">
                <label for="isActive">{{ trans('productEdit.labels.banned') }}?</label>
                <input
                    class="form-check" type="checkbox" name="isActive[]" id="isActive" value="{{ $product->isActive }}"
                    @if ($product->isActive == true) checked @endif>
            </div>
            <button class="btn btn-primary" type="submit">Actualizar Producto{{ trans('productEdit.buttons.submit') }}</button>
        </form>

    </div>


@endsection
