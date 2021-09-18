@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-8">
            <img src="/storage/{{$post->image}}" class="w-100" style="max-width:700px">
        </div>

        <div class="col-4">
            <li class="nav-item dropdown text-dark" style="list-style: none;">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="float: right; font-size:30px; margin-top:-30px"> ... </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a href="" class="dropdown-item">
                        <a href="/edit/{{$post->id}}" class="btn ml-2">
                            <img src="/img/edit.png" class="rounded-circle w-100" style="max-width: 30px;">
                            <span class="text-dark font-weight-bold pl-3 pt-1 pr-2"> Edit </span>
                        </a>
                    </a>

                    <a class="dropdown-item" href="">
                        <a href="/destroy/{{$post->id}} " class="btn ml-2" onclick="return confirm('Are you sure you want delete it?')">
                            <img src="/img/delete.png" class="w-100" style="max-width: 30px;">
                            <span class="text-dark font-weight-bold pl-3"> Delete </span>
                        </a>


                    </a>
                </div>
                <!-- <button class="font-weight-bold btn rounded-circle" id="editButton" >...</button> -->
            </li>

            <div class="d-flex align-items-center">
                <div class="pr-3">
                    <img src="{{ $post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width: 60px; margin-top: -20px;">
                </div>
                <div>
                    <h5 class="font-weight-bold">
                        <a href="/profile/{{$post->user->id }}">
                            <span class="text-dark">
                                {{ $post->user->username}}
                            </span>
                        </a>
                    </h5>

                    <p>{{$post->created_at->format('Y-m-d h:m')}}</p>
                </div>
            </div>
            <div class="ml-5">
                <p class="pt-2 pb-4">
                    {{$post->caption}}
                </p>
            </div>
            <hr>
            <div>
                <span class="font-weight-bold" style="color: gray;">{{$post->reacts->count()}} react/s on this post</span>
            </div>
            <hr>

            <form action="{{ route('profile.comment',$post->id) }}" method="post" class="d-flex">
                @csrf

                <img src="/storage/{{ auth()->user()->profile->image }}" class="rounded-circle w-100 ml-3" style="max-width: 40px;">
                <input type="text" class="form-control ml-1" style=" border-radius: 25px;width:120%" name="comment" placeholder="comment here...">
            </form>

            @foreach ($post->comments as $comment)
            <div class="align-items-center mt-2 d-flex offset-1" style="border: white;">
                <img src="/storage/{{ $comment->user->profile->image }}" class="rounded-circle w-100" style="max-width: 35px;">
                <p style="font-size:10px;margin-left:2%"><strong style="font-size:13px"> {{ $comment->user->name}} </strong> <br> {{$post->created_at->format('Y-m-d h:m')}} <br></p>
                <p class="ml-3"><span class="font-weight-bold" style="font-size:15px;">:</span> {{ $comment->comment}} </p>
            </div>
            @endforeach

        </div>
    </div>


</div>
@endsection