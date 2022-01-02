@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Estas en línea!') }}

                    <div class="m-4">
                        @if (Auth::user()->is_admin == 1)

                                <a class="btn btn-secondary" href="{{ route('users.index') }}" role="button">Panel de administración de usuarios</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
