@extends('layouts.app')

@section('content')

    <div class="container" style="text-align: center">

        <h1 style="margin-top: 50px"> {{ trans('downloadExport.titles.exportReady') }}</h1>

        <a class="btn btn-warning" href="{{ route('downloadExport', $path) }}" role="button">{{ trans('downloadExport.buttons.download') }}</a>

    </div>


@endsection
