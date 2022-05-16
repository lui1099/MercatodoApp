@extends('layouts.app')

@section('content')

<div class="container">
    <a role="button" href="{{route('home')}}" class="btn btn-dark">Volver</a>
</div>
<div class="container" style="margin-top: 50px">
    <form id="product_form" action="{{ route('products.store') }}" method="post">

        @csrf
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
            <input name="name" type="text" required>
        </div>
        <div class="mb-3">
            <label for="brand">{{ trans('createproduct.fields.brand') }}</label>
            <input name="brand" type="text" required>
        </div>
        <div class="mb-3">
            <label for="price">{{ trans('createproduct.fields.price') }}</label>
            <input name="price" type="number" required>
        </div>
        <div class="mb-3">
            <label for="stock">{{ trans('createproduct.fields.stock') }}</label>
            <input name="stock" type="number" required>
        </div>
        <div class="mb-3">
            <label for="available">{{ trans('createproduct.fields.available') }}</label>
            <input name="available" type="number" required>
        </div>
        <div class="mb-3">
            <label for="reference">{{ trans('createproduct.fields.reference') }}</label>
            <input name="reference" type="text" required>
        </div>
        <div class="mb-3">
            <label for="category">{{ trans('createproduct.fields.category') }}</label>
            <select name="category" id="category">
                <option value="food" >{{ trans('createproduct.cascade.food') }}</option>
                <option value="health&pc" >{{ trans('createproduct.cascade.health&pc') }}</option>
                <option value="cleaning" >{{ trans('createproduct.cascade.cleaning') }}</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="description" style="vertical-align: center">{{ trans('createproduct.fields.description') }}</label>
            <textarea style="vertical-align: middle" cols="90" name="description" id="description" type="text" ></textarea>
        </div>
        <button class="btn btn-primary" type="submit">{{ trans('createproduct.buttons.submit') }}</button>
    </form>

</div>

@endsection
