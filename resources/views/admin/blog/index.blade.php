@extends('admin.dashboard.dashboard')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th>body</th>
            <th>description</th>
{{--            <th>Category</th>--}}

            <th>settings</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $blog)
            <tr>
                <td>{{$blog->id}}</td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->body}}</td>
                <td>{{$blog->description}}</td>
{{--                <td>{{$blog->category->name}}</td>--}}
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.blog.show',$blog->id)}}" class="btn btn-primary">show</a>
                        <a href="{{route('admin.blog.edit',$blog->id)}}" class="btn btn-info mr-1">Edit</a>
                        <form action="{{route('admin.blog.destroy',$blog->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>


                </td>

            </tr>
        @endforeach

        </tbody>
    </table>
    {{$items->links()}}

@endsection
