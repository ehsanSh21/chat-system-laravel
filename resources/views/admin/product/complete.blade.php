@extends('admin.dashboard.dashboard')

@section('content')

<form action="{{route('admin.product.kharid',$basket)}}" method="post" class="m-5" novalidate>
    @csrf

    @foreach($basket->items as $item)
        <div class="form-group">
            <label for="{{$item->product->id}}">{{$item->product->title}}</label>
            <input type="text" placeholder="Qty" name="{{$item->product->id}}" class="border shadow ml-2">
            <input type="text" placeholder="discount code" name="{{$item->product->id."code"}}" class="border shadow ml-2">
        </div>
    @endforeach

    <button type="submit" class="btn btn-outline-primary"> Submit </button>
</form>

@endsection
