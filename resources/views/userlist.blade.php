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
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td> @if ($user->is_admin == 1) Admin @else Usuario @endif </td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td style="text-align:center">@if ($user->is_admin == 0) <button type="button" class="btn btn-danger">Eliminar Usuario</button> @else - @endif

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
