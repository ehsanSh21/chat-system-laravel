@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
{{--                    <form method="POST" action="{{route('register')}}" novalidate>--}}
{{--                        @csrf--}}
{{--                        <div class="row mb-3">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" t                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ype="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('last name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">--}}

{{--                                @error('last_name')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                    <form action="{{route('register')}}" method="post" class="m-5" novalidate>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
