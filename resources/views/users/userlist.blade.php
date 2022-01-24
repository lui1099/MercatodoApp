@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Rol</th>
                <th scope="col">Nombre</th>
                <th scope="col">e-mail</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td> @if ($user->role == 'admin')
                            Admin
                        @elseif ($user->role == 'user')
                            Usuario
                        @endif
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td style="text-align:center">
                        @if ($user->role != 'admin')
                            <button type="button" class="btn btn-danger"
                            onclick="
                            event.preventDefault();
                            document.getElementById('delete-user-form-{{ $user->id }}').submit();
                            return confirm('Esta seguro que quiere eliminar el usuario {{ $user->name }} con id {{ $user->id }}?')">

                                Eliminar Usuario
                            </button>
{{--                            <form id="delete-user-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none">--}}
{{--                                  @csrf--}}
{{--                                      @method("DELETE")--}}

{{--                            </form>--}}
                        @else -
                        @endif
                    </td>

                    <td style="text-align:center">
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}" role="button">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
