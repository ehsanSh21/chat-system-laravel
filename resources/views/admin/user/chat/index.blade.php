@extends('admin.dashboard.dashboard')

@section('content')


    <h4 class="display-4" style="direction: ltr">choose an admin for chat!</h4>
<div class="d-flex flex-column border" style="direction: ltr">


    @foreach($admins as $admin)

            <a class="text-decoration-none d-flex justify-content-between" href="{{route('admin.message',$admin)}}">
                <p> {{$admin->name." ".$admin->last_name}} </p>
                <div class="d-flex justify-content-between border-bottom">
                    <p class="ms-5" style="color:black !important">new messages:</p>
                    <span style="border-radius: 50%;padding: 8px;font-size: 18px;color: linen" class="ms-1 bg-danger d-flex align-items-center">
                        {{auth()->user()->notSeenMessages($admin->id)}}
                    </span>

                    <a href="{{route('admin.user.pin',$admin)}}">
                        @if($admin->pin!=null)
                            <i style="rotate: 60deg;" class="fa-solid fa-thumbtack"></i>
                        @else
                            <i  class="fa-solid fa-thumbtack"></i>
                        @endif

                    </a>
                </div>
            </a>



    @endforeach
</div>



@endsection
