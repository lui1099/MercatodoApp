@extends('layouts.app')

@section('content')
    <div class="container" style="text-align: center">
        <h1 style="margin-top: 50px"> {{ trans('exportView.titles.exportProductList') }}</h1>
        <div style="margin-top: 50px">

            @if(session()->has('message'))
                <div class="alert-success">{{ session('message') }}</div>
            @endif

        </div>
        <div style="margin-top: 50px">
            <form method="POST" action="{{ route('products.export') }}">
                @csrf

                <label for="category">{{ trans('exportView.labels.categories') }}</label>
                <select id="category" name="category">
                    <option value="all">{{ trans('exportView.options.all') }}</option>
                    <option value="food">{{ trans('exportView.options.food') }}</option>
                    <option value="health&pc">{{ trans('exportView.options.health&pc') }}</option>
                    <option value="cleaning">{{ trans('exportView.options.cleaning') }}</option>

                </select>
                <br><br>
                <button class="btn btn-info" type="submit">{{ trans('exportView.buttons.download') }}</button>
            </form>

        </div>





    </div>

@endsection
