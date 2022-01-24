@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('users.update', $user->id) }}">

            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name">Nombre de Usuario</label>
                <input name="name" type="text" value="{{ old('name') }} @isset($user) {{ $user->name }} @endisset" required>
                @error('name') {{ $message }} @enderror
            </div>


            <div class="mb-3">
                <label for="is_banned">Inhabilitado?</label>
                <input
                    class="form-check" type="checkbox" name="is_banned[]" id="is_banned" value="{{ $user->is_banned }}"
                    @if ($user->is_banned == true) checked @endif>
                @error('is_banned') {{ $message }} @enderror
            </div>



            <button  type="submit" class="btn btn-primary">Enviar Cambios</button>

            <a class="btn btn-secondary" href="{{ route('users.index') }}" role="button">Volver</a>

        </form>
    </div>
@endsection
