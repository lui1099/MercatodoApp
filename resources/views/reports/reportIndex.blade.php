@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <h3>{{ trans('reportIndex.titles.reports') }}</h3>
            <div class="col-4" style="margin-top: 30px">
                <form method="POST" action="{{ route('totalSalesByCtgry') }}">
                    @csrf

                    <label for="initialDate">{{ trans('reportIndex.fields.initialDate') }}</label>
                    <input id="initialDate" type="date" name="initialDate">
                    <br>
                    <br>
                    <label for="finalDate">{{ trans('reportIndex.fields.finalDate') }}</label>
                    <input id="finalDate" type="date" name="finalDate" value="{{ $now }}">
                    <br>
                    <br>
                    <button class="btn btn-warning" type="submit">{{ trans('reportIndex.buttons.sales') }}</button>
                </form>

            </div>



        </div>






    </div>


@endsection
