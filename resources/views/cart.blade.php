@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 50px">
        @if($cartContent->count()>0)
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
                        <td>{{$item->price}}</td>
                        <td>{{$item->price*$item->qty}}</td>
                        <td>
                            <button type="button" class="btn btn-danger"
                                     onclick="
                                         event.preventDefault();
                                         document.getElementById('deleteCartItem{{ $item->rowId }}').submit();
                                         return confirm('{{ trans('cart.confirm.sureDeleteItem') }}{{ $item->name }} x {{$item->qty}} ?')">
                                {{ trans('cart.buttons.deleteItem') }}
                            </button>
                            <form id="deleteCartItem{{ $item->rowId }}" action="{{ route('cart.deleteItem', $item->rowId) }}" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                            </form>


                        </td>
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
            <div>
                <button type="button" class="btn btn-danger"
                        onclick="
                            event.preventDefault();
                            document.getElementById('clearCart').submit();
                            return confirm('{{ trans('cart.confirm.clearCart') }}')">

                    {{ trans('cart.buttons.clearCart') }}
                </button>
                <form id="clearCart" action="{{ route('cart.destroy') }}" method="POST" style="display: none">
                    @csrf
{{--                        @method("DELETE")--}}
                </form>
            </div>
        @elseif($cartContent->count() == 0)
            <div style="text-align: center">
                <h1 style="font-weight: bolder; alignment: center" > {{ trans('cart.messages.emptyCart') }} </h1>
            </div>
        @endif
    </div>
@endsection
