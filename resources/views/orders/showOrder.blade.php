@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top: 50px">
        <table class="table">
            <tr>
                <td><h3>Referencia: {{ $order->reference }}</h3></td>
                <td> Estado de la Orden:
                    @if($order->status == 'pending')
                        <h3 style="color: orange; font-weight: bolder" > {{ trans('showOrder.status.pending') }}</h3>
                        <form action="{{ route('orders.refresh', $order) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-outline-danger">{{ trans('showOrder.buttons.refreshOrder') }}</button>

                        </form>

                    @elseif($order->status == 'approved')
                        <h3 style="color: limegreen; font-weight: bolder"> {{ trans('showOrder.status.approved') }}</h3>
                    @elseif($order->status == 'rejected')
                        <h3 style="color: darkred; font-weight: bolder"> {{ trans('showOrder.status.rejected') }} </h3>

                        <form action="{{ route('orders.retry', $order) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-danger">{{ trans('showOrder.buttons.retryOrder') }}</button>

                        </form>
                    @endif
                </td>
            </tr>
        </table>
        <h2>Carrito de Compras de la Orden</h2>

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
                <td style="font-weight: bolder">Total: {{ $order->total }} COP</td>
            </tr>

            </tbody>
        </table>

    </div>




@endsection
