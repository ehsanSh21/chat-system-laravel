@extends('admin.dashboard.dashboard')

@section('content')

    <div style="font-size: 30px" class="w-100 d-flex p-2">
        <div style="background-color: #9deac2" class="">
            <div>
                basket:
            </div>
        </div>
        <div>
             {{$basket->count()}}
        </div>

        <div>

            @if($basket->count()!=0)
                <a href="{{route('admin.product.order',$basket[0]->order)}}" class="btn btn-info mr-1">complite order</a>
            @endif


        </div>

    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th>body</th>
            <th>description</th>
            <th>Price</th>

            <th>settings</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->title}}</td>
                <td>{{$product->body}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.product.show',$product->id)}}" class="btn btn-primary">show</a>
                        <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-info mr-1">Edit</a>
                        <form action="{{route('admin.product.destroy',$product->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>

                        @if($product->isOrderd())
                            <a href="{{route('admin.product.order-cancel',$product)}}" class="btn btn-outline-danger mr-1">
                                Added
                            </a>
                        @else
                            <a href="{{route('admin.product.buy',$product)}}" class="btn btn-info mr-1">
                                Buy
                            </a>
                        @endif

                    </div>


                </td>

            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
