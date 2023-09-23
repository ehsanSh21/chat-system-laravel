@extends('admin.dashboard.dashboard')

@section('content')

    <form action="{{route('admin.user.store')}}" method="post" class="m-5" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">name:</label>
            <input type="text" value="{{old('name')}}" name="name" class="border shadow ml-2">
            @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="last_name">last name:</label>
            <input type="text" value="{{old('last_name')}}" name="last_name" class="border shadow ml-2">
            @error('last_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">email:</label>
            <input type="text" value="{{old('email')}}" name="email" class="border shadow ml-2" >
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">phone number:</label>
            <input type="text" value="{{old('phone')}}" name="phone" class="border shadow ml-2">
            @error('phone')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">password:</label>
            <input type="password" name="password" class="border shadow ml-2" >
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-primary"> Submit </button>
    </form>



@endsection
