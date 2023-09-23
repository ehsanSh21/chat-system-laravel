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
    <div class="border">

        <form style="display: inline" action="{{route('like',['type'=>'blog','id'=>$blog])}}" method="post"
              class="m-5" novalidate>
            @csrf
            @method('PATCH')

            @if($blog->likes->pluck('user_id')->contains(auth()->user()->id))
                <button type="submit" class="btn btn-outline-danger">Dislike</button>
            @else
                <button type="submit" class="btn btn-outline-primary">Like</button>
            @endif

        </form>

        <p class="d-inline">likes Count</p>
        <p class="text-primary" style="display: inline">
            {{$blog->likes->count()}}
        </p>

    </div>



    <h3 class="display-5 text-primary">published comments</h3>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">comment</th>
            <th>rep</th>
        </tr>
        </thead>

        <tbody>
        @foreach($comments as $comment)

            <tr>
                <td>{{$comment->id}}</td>
                <td class="d-flex flex-column">
                    <p>{{$comment->body}}<p>


                    @foreach($comment->children as $reply)
                        @if($reply)
                            <p class="text-danger"
                               style="position: relative;font-size: 18px;margin-bottom: -10px;margin-right: 25px;background-color: #3d4046;padding: 0px">
                                reply:
                                <span class="text-light">
                                    {{array_search($reply->toArray(),$comment->children->toArray())+1}}
                                </span>
                            </p>
                            <div class="d-flex flex-column m-2 p-2" style="border: 2px dotted #6e2994">


                                <div class="d-flex justify-content-between">


                                    <p>{{$reply->body}}</p>
                                    <div>
                                        <button class="btn btn-outline-danger align-self-start mt-2" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target={{"#collapseExample$reply->id"}} aria-expanded="false">
                                            Rep
                                        </button>

                                        <div class="collapse" id={{"collapseExample$reply->id"}}>
                                            <form action="{{route('reply.store',[$reply->id,$reply->depth+1])}}"
                                                  method="post" class="m-3" novalidate>
                                                @csrf
                                                <div class="mb-3 row">
                                                    <label for="inputPassword"
                                                           class="col-sm-2 col-form-label">Reply</label>
                                                    <div class="col-sm-10">
                                                        <input name="body" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-outline-primary"> Submit
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                                @foreach($reply->children as $reply)

                                    <div class="d-flex flex-column mx-3 my-1" style="border: 1px dotted #851a75">
                                        {{$reply->body}}
                                    </div>

                                @endforeach

                            </div>

                        @endif

                    @endforeach


                </td>
                <td>
                    <div>
                        <button class="btn btn-outline-danger align-self-start mt-2" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target={{"#collapseExample$comment->id"}} aria-expanded="false">
                            Rep
                        </button>

                        <div class="collapse" id={{"collapseExample$comment->id"}}>
                            <form action="{{route('reply.store',[$comment->id,$comment->depth+1])}}"
                                  method="post" class="m-3" novalidate>
                                @csrf
                                <div class="mb-3 row">
                                    <label for="inputPassword"
                                           class="col-sm-2 col-form-label">Reply</label>
                                    <div class="col-sm-10">
                                        <input name="body" type="text" class="form-control">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-primary"> Submit
                                </button>
                            </form>
                        </div>

                    </div>
                </td>
            </tr>

        @endforeach


        </tbody>

    </table>



    <h3 class="display-5 text-danger">not published comments</h3>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">comment</th>
            <th>setting</th>

        </tr>
        </thead>

        <tbody>

        @foreach ($blog->comments as $comment )
            @if ($comment->published==0 && $comment->parent_id==null)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->body}}</td>
                    <td>
                        <a href="/approve/{{$comment->id}}" class="btn btn-primary">publish</a>
                    </td>
                </tr>
            @endif

        @endforeach

        </tbody>

    </table>

    <h3 class="display-5 text-info">insert comments</h3>

    <form action="{{route('comment.store',$blog->id)}}" method="post" class="m-3" novalidate>
        @csrf
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext text-success" name="email"
                       value="{{auth()->user()->email}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Comment</label>
            <div class="col-sm-10">
                <input name="body" type="text" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-outline-primary"> Submit</button>
    </form>

@endsection
