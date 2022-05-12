@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 50px; text-align: center">

        <h1>{{ trans('importProducts.titles.importProduct') }}</h1>

        <div style="margin-top: 50px">

            @if(session()->has('message'))
                <div class="alert-success">{{ session('message') }}</div>
            @endif

        </div>

        <div style="margin-top: 50px">
            <form enctype="multipart/form-data" action="{{ route('products.import') }}" method="POST">
                @csrf
                <input type="file" name="sheet" required accept=".xlsx,.xls,.csv">
                <button class="btn btn-primary" type="submit">Importar</button>
            </form>
        </div>





    </div>





@endsection
