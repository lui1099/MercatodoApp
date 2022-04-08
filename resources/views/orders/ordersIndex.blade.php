@extends('layouts.app')

@section('content')

    <div class="container">
        <a role="button" href="{{route('home')}}" class="btn btn-dark">{{ trans('orderlist.buttons.back') }}</a>
    </div>
    <div class="container" style="margin-top: 50px">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ trans('orderlist.tableHeaders.reference') }}</th>
                <th scope="col">{{ trans('orderlist.tableHeaders.createdAt') }}</th>
                <th scope="col">{{ trans('orderlist.tableHeaders.total') }}</th>
                <th scope="col">{{ trans('orderlist.tableHeaders.status') }}</th>
                <th scope="col">{{ trans('orderlist.tableHeaders.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->reference}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>COP {{$order->total}}</td>
                    <td>

                        @if($order->status == 'pending')
                            <p style="color: orange; font-weight: bolder" > PENDIENTE </p>
                        @elseif($order->status == 'approved')
                            <p style="color: limegreen; font-weight: bolder"> APROBADA </p>
                        @elseif($order->status == 'rejected')
                            <p style="color: darkred; font-weight: bolder"> RECHAZADA </p>
                        @endif

                    </td>

                    <td style="text-align:center">
                        <a class="btn btn-primary" href="{{ route('orders.show', $order->id) }}" role="button">{{ trans('orderlist.buttons.show') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}

    </div>



@endsection
