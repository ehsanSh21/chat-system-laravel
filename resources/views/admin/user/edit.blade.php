@extends('admin.dashboard.dashboard')

@section('content')

    <form action="{{route('admin.user.update',$user->id)}}" method="post" class="m-5" novalidate>
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">name:</label>
            <input type="text" value="{{$user->name}}" name="name" class="border shadow ml-2">
            @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">last name:</label>
            <input type="text" value="{{$user->last_name}}" name="last_name" class="border shadow ml-2">
            @error('last_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">phone:</label>
            <input type="text" value="{{$user->phone}}" name="phone" class="border shadow ml-2">
            @error('phone')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">email:</label>
            <input type="text" value="{{$user->email}}" name="email" class="border shadow ml-2" >
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-primary"> Submit </button>
    </form>


@endsection
