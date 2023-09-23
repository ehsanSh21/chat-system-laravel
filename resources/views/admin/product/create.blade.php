@extends('admin.dashboard.dashboard')

@section('content')

    <form action="{{route('admin.product.store')}}" method="post" class="m-5" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">title:</label>
            <input type="text" value="{{old('title')}}" name="title" class="border shadow ml-2">
            @error('title')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="body">body:</label>
            <input type="text" value="{{old('body')}}" name="body" class="border shadow ml-2">
            @error('body')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">description:</label>
            <textarea name="description" type="text" >
                {!! old('description') !!}
            </textarea>
            @error('description')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-primary"> Submit </button>
    </form>



@endsection
