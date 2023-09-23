@extends('admin.dashboard.dashboard')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th>last name</th>
            <th>phone number</th>
            <th scope="col">email</th>
            <th>image url</th>
            <th>settings</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if(isset($user->image->url))
                        {{$user->image->url}}
                    @else
                        {!! 'no image' !!}
                    @endif

                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.user.show',$user->id)}}" class="btn btn-primary">show</a>
                        <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-info mr-1">Edit</a>
                        <form action="{{route('admin.user.destroy',$user->id)}}" method="post">
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
