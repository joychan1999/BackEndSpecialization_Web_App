@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <div>
        <div>
            <h3>Suggested People:</h3>
        </div>
        <div>

            @foreach($profiles as $profile)

            <div class="d-flex">
                @if(auth()->user()->id != $profile->user_id)
                <a href="/profile/{{$profile->user_id }}" class="btn">
                    <img src="/storage/{{ $profile->image }}" class="rounded-circle w-100" style="max-width: 30px;">
                    <span class="text-dark font-weight-bold pl-3 pt-1 pr-2">
                        {{$profile->title}}
                    </span>

                </a>
                @endif


            </div>

            @endforeach
        </div>
    </div>
    <div>
        <form action="/newsFeed" method="post" enctype="multipart/form-data">
            @csrf
            <div class=" offset-3 pt-4 pb-2 mb-4" style="background-color: #DCDCDC; border-radius: 10px; margin-left: 200px;">
                <div class="pr-3 d-flex">
                    <img src="{{ auth()->user()->profile->profileImage()}}" class="rounded-circle w-100" style="max-width: 60px; margin-top: -10px;">
                    <input class="form-control @error('caption') is-invalid @enderror w-100 ml-2 " type="text" placeholder="what's on your mind? {{auth()->user()->username}}" style="margin-top: -10px; height:48px; border-radius:10px;" name="caption" autofocus>

                    @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong style="font-size: 10px; color: red;">{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div style="margin-left: 70px;" class="d-flex">
                    <input type="file" class="form-control-file w-50" id="image" name="image">

                    @error('image')
                    <strong style="font-size: 10px; color: red;">{{$message}}</strong>
                    @enderror
                </div>
                <div>
                    <button class="btn btn-primary rounded" type="submit" style="margin-left: 600px;"> Add Post</button>
                </div>

            </div>
        </form>

        @foreach($posts as $post)
        <div class="row">
            <div class=" offset-3 pt-4 pb-2 mb-4" style="background-color: #DCDCDC; border-radius: 10px; margin-left: 200px;">

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
                <a href="/post/{{ $post->id }}">
                    <img src="/storage/{{$post->image}}" class="w-100 p-2">
                </a>
                <react-button :post="{{$post}}" :user_id="{{auth()->user()->id}}" class="pb-3"></react-button>

                <form action="{{ route('profile.comment',$post->id) }}" method="post" class="d-flex">
                    @csrf

                    <img src="/storage/{{ auth()->user()->profile->image }}" class="rounded-circle w-100 ml-3" style="max-width: 40px;">
                    <input type="text" class="form-control" style=" border-radius: 25px;width:120%" name="comment" placeholder="comment here...">
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


        @endforeach


        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{$posts->links()}}
            </div>
        </div>
        @endsection