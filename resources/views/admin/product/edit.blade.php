@extends('admin.dashboard.dashboard')

@section('content')

    <form action="{{route('admin.blog.update',$blog->id)}}" method="post" class="m-5" novalidate>
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">title:</label>
            <input type="text" value="{{$blog->title}}" name="title" class="border shadow ml-2">
            @error('title')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">body:</label>
            <input type="text" value="{{$blog->body}}" name="body" class="border shadow ml-2">
            @error('body')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">desc:</label>

            <textarea name="description">
                {!! $blog->description !!}
            </textarea>
            @error('description')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>


        <button type="submit" class="btn btn-outline-primary"> Submit </button>
    </form>


@endsection
