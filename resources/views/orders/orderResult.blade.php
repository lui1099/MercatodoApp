@extends('layouts.app')

@section('content')

    <div class="container">
        <a role="button" href="{{route('home')}}" class="btn btn-dark">{{ trans('orderResult.buttons.dashboard') }}</a>
    </div>

    <div class="container" style="margin-top: 50px; text-align: center">

        <div> {{ trans('orderResult.titles.status') }}:
            @if($orderStatus == 'pending')
                <h3 style="color: orange; font-weight: bolder" > {{ trans('showOrder.status.pending') }}</h3>

            @elseif($orderStatus == 'approved')
                <h3 style="color: limegreen; font-weight: bolder"> {{ trans('showOrder.status.approved') }}</h3>
            @elseif($orderStatus == 'rejected')
                <h3 style="color: darkred; font-weight: bolder"> {{ trans('showOrder.status.rejected') }} </h3>

            @endif
        </div>

        <h2 style="font-weight: bolder">{{ trans('orderResult.titles.shoppingCart') }}</h2>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ trans('cart.tableHeaders.name') }}</th>
                <th scope="col">{{ trans('cart.tableHeaders.qty') }}</th>
                <th scope="col">{{ trans('cart.tableHeaders.unitPrice') }}</th>
                <th scope="col">{{ trans('cart.tableHeaders.totalPerItem') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartContent as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->pricePerUnit}}</td>
                    <td>{{$item->pricePerItem}}</td>

                </tr>
            @endforeach
            <tr style="border-bottom:2px solid black">
                <td colspan="100%"></td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td style="font-weight: bolder">Total: {{ $total }} COP</td>
            </tr>

            </tbody>
        </table>




    </div>

@endsection
