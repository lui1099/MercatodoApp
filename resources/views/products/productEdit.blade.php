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
                <label for="name">Nombre del Producto</label>
                <input name="name" value="{{ old('name') }} @isset($product) {{ $product->name }} @endisset" type="text" required>
            </div>
            <div class="mb-3">
                <label for="brand">Marca del Producto</label>
                <input name="brand" value="{{ old('brand') }} @isset($product) {{ $product->brand }} @endisset" type="text" required>
            </div>
            <div class="mb-3">
                <label for="price">Precio por unidad, COP</label>
                <input name="price" type="text" value="{{ old('price') }} @isset($product) {{ $product->price }} @endisset" required>
            </div>
            <div class="mb-3">
                <label for="category">Categoria</label>
                <select name="category" id="category">
                    <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Comida y bebidas</option>
                    <option value="health&pc" {{ old('category') == 'health&pc' ? 'selected' : '' }}>Salud y cuidado personal</option>
                    <option value="cleaning" {{ old('category') == 'cleaning' ? 'selected' : '' }}>Limpieza</option>

                </select>
            </div>
            <div class="mb-3">
                <label for="description" style="vertical-align: center">Descripcion del producto</label>
                <textarea style="vertical-align: middle" cols="90" name="description" id="description" type="text"  >{{ old('description') }} @isset($product) {{ $product->description }} @endisset</textarea>
            </div>
            <div class="mb-3">
                <label for="isActive">Habilitado?</label>
                <input
                    class="form-check" type="checkbox" name="isActive[]" id="isActive" value="{{ $product->isActive }}"
                    @if ($product->isActive == true) checked @endif>
            </div>
            <button class="btn btn-primary" type="submit">Actualizar Producto</button>
        </form>

    </div>1


@endsection
