@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 50px">
        <h1>Seleccione las imagenes del producto</h1>
        <h3> Producto: {{ session()->get('product')->name }}</h3>
        <h3> Id: {{ session()->get('product')->id }}</h3>
        <h3> Marca: {{ session()->get('product')->brand }}</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="image_form" action="{{ route('store.images', session()->get('product')->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="picture1">
            </div>

            <div class="mb-3">
                <input type="file" name="picture2">
            </div>

            <div class="mb-3">
                <input type="file" name="picture3">
            </div>
            <button class="btn btn-primary" type="submit">Subir imagenes</button>
            <a href="{{ route('products.index') }}" class="btn btn-dark">Guardar producto sin foto</a>
        </form>


    @php
        {{Session::reflash();}}
    @endphp
@endsection
