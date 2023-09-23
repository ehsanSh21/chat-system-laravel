@extends('admin.dashboard.dashboard')

@section('content')
    <h5 style="direction: ltr" class="display-5">chat with
<span class="text-danger">{{$user->name}} </span> !</h5>

<div  class="d-flex flex-column px-5">
    @foreach($messages as $message)
        <div class="row">
            @if(auth()->user()->id==$message->user_id)

                <div style="position: relative;overflow: hidden ;background-color: #d2edd2;border-radius:30px;margin: 7px" class="flex-column  p-2 col-6 ms-auto">

                    <div  class="row">
                        <div class="col-6">
                            <p class="m-0">{{$message->body}}</p>
                        </div>

                        @if($message->reply)
                        <div style="position: absolute ;margin-top: 30px;border-radius: 15px;background-color: #72b1c9" class="col-6">
                            <p style="direction: ltr" class="m-0 p-1">

{{--                                    {{$message->reply->body}}--}}
                                {{ Illuminate\Support\Str::limit($message->reply->body, 13) }}

                            </p>
                        </div>
                        @endif

                    </div>

                    <div class="row" style="direction: ltr">
                        <div class="col-6">

                            @if($message->chat_partner_seen==0)
                                <i class="fa-solid fa-check"></i>
                                <i style="color: rgba(50,50,50,0.35)" class="fa-solid fa-check"></i>
                            @else
                                <i class="fa-solid fa-check"></i>
                                <i class="fa-solid fa-check"></i>
                            @endif


                        </div>
                    </div>

                </div>
            @else
                <div style="background-color: #72b1c9;border-radius:30px;margin: 7px" class="flex-column p-2 col-6 me-auto">
                    <div class="row">
                        <div style="position: relative;z-index: 40" class="col-6 d-flex">
{{--                            <a href="{{route('admin.reply.message',$message)}}"  style="position: absolute;margin-right: -60px;padding: 6px;margin-top:4px" class="btn btn-primary ms-1">Re</a>--}}
                            <div style="position: absolute;margin-right: -60px">
                                <button class="btn btn-outline-danger align-self-start mt-2" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target={{"#collapseExample$message->id"}} aria-expanded="false">
                                    Rep
                                </button>

                                <div class="collapse" id={{"collapseExample$message->id"}}>
                                    <form style="direction: rtl"
                                        action="{{route('admin.reply.message',['user' => $user,'message' => $message])}}"
                                          method="post" class="m-3 d-flex" novalidate
                                    >
                                        @csrf
                                        <div class="mb-3 row">
                                            <label for="inputPassword"
                                                   class="col-sm-2 col-form-label">Reply</label>
                                            <div class="col-sm-10">
                                                <input style="z-index: 500;background-color: rgba(210,237,210,0.5)" name="body" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-outline-primary"> Submit
                                        </button>
                                    </form>
                                </div>

                            </div>
                            <p class="m-0">{{$message->body}}</p>
                        </div>
                    </div>

                    <div class="row" style="direction: ltr">
                        <div class="col-6">


                            @if($message->reply)

                                <p class="m-0 p-1" style="border-radius: 15px;margin-top: 45px ;background-color: #d2edd2">

                                    {{ Illuminate\Support\Str::limit($message->reply->body, 13) }}
                                </p>
                            @else
                                <p class="m-0" style="font-size:15px ">{{$message->created_at}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

        </div>

    @endforeach
</div>

    <form action="{{route('admin.store.message',$user)}}" method="post" class="m-5" novalidate>
        @csrf

        <div class="form-group">
            <label for="body">message:</label>
            <input type="text" value="{{old('body')}}" name="body" class="border shadow ml-2">
        </div>
        <button type="submit" class="btn btn-outline-primary"> Submit </button>
    </form>

@endsection
