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
                        @if (Auth::user()->role == 'admin')

                                <a class="btn btn-secondary" href="{{ route('users.index') }}" role="button"> {{ __('home.buttons.userPanel') }}</a>
                        @endif
                    </div>

                    <div class="m-4">
                        @if (Auth::user()->role == 'admin')
                            <a class="btn btn-warning" href="{{ route('products.index') }}" role="button">{{ trans('home.buttons.viewEditProducts') }}</a>
                            <a class="btn btn-warning" href="{{ route('products.create2') }}" role="button">{{ trans('home.buttons.addNewProduct') }}</a>
                        @else
                            <a class="btn btn-warning" href="{{ route('products.index') }}" role="button">{{ trans('home.buttons.showProducts') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
