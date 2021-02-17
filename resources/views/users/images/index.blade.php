@extends('layouts.app')

@section('content')
    <h4 class="mt-4 text-center">{{$user->name}}</h4>
    <p class="text-center">Posted <strong>{{$images->count()}}</strong>
        {{Str::plural('post', $images->count())}}
        and recieved <strong>{{$user->recievedLikes->count()}}</strong>
        {{Str::plural('like', $user->recievedLikes->count() )}}
    </p>
    @include('_partials.posts')

@endsection
