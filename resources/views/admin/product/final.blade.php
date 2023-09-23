@extends('admin.dashboard.dashboard')

@section('content')

{{--    <div class="row">--}}
{{--        <div class="col-6">{{$item->price}}</div>--}}
{{--        <div class="col-6">{{$item->useDiscount}}</div>--}}
{{--    </div>--}}

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">price of each one</th>
            <th scope="col">qty</th>
            <th scope="col">total price(without discount)</th>
            <th scope="col">total price(with discount)</th>
            <th scope="col">discount amount</th>

        </tr>
        </thead>
        <tbody>
        @foreach($basket->items as $item)
        <tr>
            <th scope="row">{{array_search($item->toArray(),$basket->items->toArray())+1}}</th>
            <td>{{$item->product->title}}</td>
            <td>{{$item->product->price}}</td>
            <td>{{$item->qty}}</td>
            <td>{{$item->qty*$item->product->price}}</td>
            <td>{{$item->price}}</td>
            <td>{{($item->qty*$item->product->price)-$item->price}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>


@endsection
