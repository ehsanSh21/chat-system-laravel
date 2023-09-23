@extends('admin.dashboard.dashboard')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th scope="col">body</th>
            <th>desc</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$blog->id}}</td>
            <td>{{$blog->title}}</td>
            <td>{{$blog->body}}</td>
            <td>{{$blog->description}} </td>
        </tr>


        </tbody>
    </table>




@endsection
