@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ trans('productlist.headers.productlist') }}</h1>
        <div class="m-4">
            <form id="searchForm" action="{{ route('products.search') }}" method="POST">
                @csrf
                <label for="search">{{ trans('productlist.fields.search') }}</label>
                <input name="search"  type="text" required>
                <button class="btn btn-primary" type="submit">{{ trans('productlist.buttons.search') }}</button>
            </form>
        </div>
        <div class="m-4">
            <h3>{{ trans('productlist.headers.byCategories') }}</h3>
            <a role="button" href="{{route('products.food')}}" class="btn btn-dark">{{ trans('productlist.buttons.food') }}</a>
            <a role="button" href="{{route('products.health')}}" class="btn btn-dark">{{ trans('productlist.buttons.health&pc') }}</a>
            <a role="button" href="{{route('products.cleaning')}}" class="btn btn-dark">{{ trans('productlist.buttons.cleaning') }}</a>
        </div>
        @foreach ($products->chunk(4) as $chunk)
            <div class="row my-4">
                @foreach ($chunk as $product)
                    <div class="col-3">
                        @if(Auth::user()->role == 'user')
                            @if($product->isActive == 1)
                                <div class="card">
                                    @if($product->image != null)
                                        <img src="{{ asset('storage/product/'.$product->image->content) }}" class="card-img-top" alt="...">
                                    @else
                                        <img src="{{ asset('storage/product/nophoto.jpg') }}" class="card-img-top" alt="...">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">$ {{ $product->price }}</h6>
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">{{ trans('productlist.buttons.showProduct') }}</a>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="card">
                                @if($product->image != null)
                                    <img src="{{ asset('storage/product/'.$product->image->content) }}" class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset('storage/product/nophoto.jpg') }}" class="card-img-top" alt="...">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">$ {{ $product->price }}</h6>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary">{{ trans('productlist.buttons.showProduct') }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
{{--    {{ $products->links() }}--}}
@endsection
