@extends('layouts.app')

@section('content')
    <div class="container">
        <a role="button" href="{{route('home')}}" class="btn btn-dark">{{ trans('userlist.fields.userName') }}</a>
    </div>
    <div class="container" style="margin-top: 50px">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ trans('userlist.tableHeaders.id') }}</th>
                <th scope="col">{{ trans('userlist.tableHeaders.role') }}</th>
                <th scope="col">{{ trans('userlist.tableHeaders.name') }}</th>
                <th scope="col">{{ trans('userlist.tableHeaders.email') }}</th>
                <th scope="col">{{ trans('userlist.tableHeaders.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td> @if ($user->role == 'admin')
                            Admin
                        @elseif ($user->role == 'user')
                            Usuario{{ trans('userlist.fields.user') }}
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
                            return confirm('{{ trans('userlist.confirm.sureDeleteUser') }}{{ $user->name }} {{ trans('userlist.confirm.withId') }} {{ $user->id }}?')">

                                {{ trans('userlist.buttons.deleteUser') }}
                            </button>
                            <form id="delete-user-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none">
                                  @csrf
                                      @method("DELETE")

                            </form>
                        @else -
                        @endif
                    </td>

                    <td style="text-align:center">
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}" role="button">Editar{{ trans('userlist.buttons.edit') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}

    </div>
@endsection
