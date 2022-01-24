@extends('layouts.app')

@section('content')

<div style="margin-left: 50px">

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="mb-3">
            <label for="name">Nombre del Producto</label>
            <input name="name" type="text" required>
        </div>
        <div class="mb-3">

        </div>
        <div class="mb-3">
            <input type="file" name="file" required>
        </div>
        <button type="submit">Crear Producto</button>
    </form>

</div>
@endsection
