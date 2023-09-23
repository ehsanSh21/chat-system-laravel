@extends('admin.dashboard.dashboard')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th>created at</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}} </td>
        </tr>


        </tbody>
    </table>



    <h3 class="display-4 text-danger">PRODUCTS</h3>
    <table class="table">
        <thead>
        <tr>

            <th>product id</th>
            <th>write</th>
            <th >title</th>
            <th >body</th>
            <th>description</th>

        </tr>
        </thead>
        <tbody>

        @foreach($user->products as $product)
            <tr>

                <td>{{$product->id}}</td>
                <td>{{$user->name." ".$user->last_name }}</td>
                <td>{{$product->title}}</td>
                <td>{{$product->body}}</td>
                <td>{{$product->description}} </td>
            </tr>
        @endforeach


        </tbody>
    </table>

    <h3 class="display-4 text-danger">BLOGS</h3>
    <table class="table">
        <thead>
        <tr>
            <th>blog id</th>
            <th>write</th>
            <th >title</th>
            <th >body</th>
            <th>description</th>

        </tr>
        </thead>
        <tbody>

        @foreach($user->blogs as $blog)
            <tr>
                <td>{{$blog->id}}</td>
                <td>{{$user->name." ".$user->last_name }}</td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->body}}</td>
                <td>{{$blog->description}} </td>
            </tr>
        @endforeach


        </tbody>
    </table>

@endsection
