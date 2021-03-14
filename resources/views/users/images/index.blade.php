@extends('layouts.app')

@section('content')
    <section class="user mt-4">
        <div class="user-avatar">
            @if($user->file_name )
                <img src="{{asset('storage/images/' . $user->file_name)}}" width="100" alt="">
            @endif
        </div>

        <div class="user-data">
            <h4 class="mt-4 text-center">{{$user->name}}</h4>
            <p class="text-center">Posted <strong>{{$images->count()}}</strong>
                {{Str::plural('post', $images->count())}}
                and recieved <strong>{{$user->recievedLikes->count()}}</strong>
                {{Str::plural('like', $user->recievedLikes->count() )}}
            </p>
        </div>

    </section>

    @include('_partials.posts')

@endsection
