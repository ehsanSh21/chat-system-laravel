@extends('admin.dashboard.dashboard')

@section('content')
{{--    @if(!Route::is('admin.products.orderByMostProfit'))--}}
{{--        <div>total orders:{{$orders->total()}}</div>--}}
{{--    @endif--}}

<div>total orders:{{$products->total()}}</div>
<br>



<div class="row">


    @foreach($products as $index => $product)

        @php
            $componentNumber = ($products->currentPage() - 1) * $products->perPage() + $index + 1;
        @endphp


        <div class="d-flex flex-column col-6 p-5" style="border: 2px black solid;position: relative">
            <span style="background-color: red ; padding: 5px 10px;margin-top: -60px;position: absolute">
           {{$componentNumber}}
            </span>
            <div>
                <div class="col-4">
                    <p>product_id: {{$product->id}}</p>
                </div>

                <div class="col-8">
                    <p> name:{{$product->title}}</p>
                    <p> price:{{$product->price}}</p>
                    <p class="bg-success text-light" style="font-size: 20px"> total qty orderd:{{$product->total_quantity}}</p>

                </div>
            </div>
            <div class="row">
                <div class="col-8">
                </div>
                <div class="col-4">
{{--                    <a href="{{route('admin.products.order-items',$order)}}">More</a>--}}
                </div>
            </div>
        </div>
        @php
            $componentNumber++;
        @endphp
    @endforeach
</div>


        {{$products->links()}}


<br>
@endsection
