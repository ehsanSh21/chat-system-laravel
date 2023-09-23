@extends('admin.dashboard.dashboard')

@section('content')
    @if(!Route::is('admin.products.orderByMostProfit'))
        <div>total orders:{{$orders->total()}}</div>
    @endif


    <div class="dropdown mb-4 mt-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown button
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li class="m-2">
        @if(Route::is('admin.products.orderByQty') )
            <a class="p-2 bg-danger"  href="{{route('admin.products.orderByQty')}}">Order by total quantity of products in each order:</a>

        @else
            <a class="p-2"  href="{{route('admin.products.orderByQty')}}">Order by total quantity of products in each order:</a>

        @endif
            </li>

            <li class="m-2">

            @if(Route::is('admin.products.orderByItems') )
                <a class="p-2 bg-danger"  href="{{route('admin.products.orderByItems')}}">sort  by most items orderd</a>

            @else
                <a class="p-2"  href="{{route('admin.products.orderByItems')}}">sort  by most items orderd</a>

            @endif
            </li>

            <li class="m-2">

            @if(Route::is('admin.products.orderByMostProfit') )
                <a class="p-2 bg-danger"  href="{{route('admin.products.orderByMostProfit')}}">sort  by most prift</a>

            @else
                <a class="p-2"  href="{{route('admin.products.orderByMostProfit')}}">sort  by most prift</a>

            @endif
            </li>

        </ul>
    </div>



<div class="row">


    @foreach($orders as $index => $order)

        @php
            $componentNumber = ($orders->currentPage() - 1) * $orders->perPage() + $index + 1;
        @endphp


        <div class="d-flex flex-column col-6 p-5" style="border: 2px black solid;position: relative">
            <span style="background-color: red ; padding: 5px 10px;margin-top: -60px;position: absolute">
           {{$componentNumber}}
            </span>
            <div>
                <div class="col-4">
                    <p>order_id: {{$order->id}}</p>
                </div>
                @if(Route::is('admin.products.orderByQty') )
                     <div class="bg-success" style="color: white">
                         total qty of order:
                         {{$order->total_quantity}}
                     </div>
                @endif
                @if(Route::is('admin.products.orderByMostProfit') )
                    <div class="bg-success" style="color: white">
                        total profit:
                        {{$order->profit}}
                    </div>
                @endif

                <div class="col-8">
                    <p> items:{{$order->items->count()}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                </div>
                <div class="col-4">
                    <a href="{{route('admin.products.order-items',$order)}}">More</a>
                </div>
            </div>
        </div>
        @php
            $componentNumber++;
        @endphp
    @endforeach
</div>

    @if(Route::is('admin.products.orderByMostProfit'))
        @if ($orders->lastPage() > 1)
            <div class="pagination">
                @if ($orders->currentPage() > 1)
                    <a class="m-2 border" href="{{ $orders->previousPageUrl() }}">Previous</a>
                @endif

                @for ($i = 1; $i <= $orders->lastPage(); $i++)
                    <a class="m-2 border" href="{{ $orders->url($i) }}" class="{{ $orders->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if ($orders->currentPage() < $orders->lastPage())
                    <a class="m-2 border" href="{{ $orders->nextPageUrl() }}">Next</a>
                @endif
            </div>
        @endif
    @else
        {{$orders->links()}}
    @endif





<br>
{{--    @foreach(auth()->user()->orders as $order)--}}
{{--        @foreach($order->items as $item)--}}
{{--            <div class="d-flex" style="border-bottom: 2px black solid">--}}
{{--                <div class="border">--}}
{{--                    {{$order->id}}--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    {{$order->items->count()}}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    @endforeach--}}

@endsection
