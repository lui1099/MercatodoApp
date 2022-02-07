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
            <label for="name">Nombre del Producto</label>
            <input name="name" type="text" required>
        </div>
        <div class="mb-3">
            <label for="brand">Marca del Producto</label>
            <input name="brand" type="text" required>
        </div>
        <div class="mb-3">
            <label for="price">Precio por unidad, COP</label>
            <input name="price" type="text" required>
        </div>
        <div class="mb-3">
            <label for="category">Categoria</label>
            <select name="category" id="category">
                <option value="food" >Comida y bebidas</option>
                <option value="health&pc" >Salud y cuidado personal</option>
                <option value="cleaning" >Limpieza</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="description" style="vertical-align: center">Descripcion del producto</label>
            <textarea style="vertical-align: middle" cols="90" name="description" id="description" type="text" ></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Crear Producto</button>
    </form>

</div>

@endsection
