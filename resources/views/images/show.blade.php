@extends('layouts.app')

@section('content')


    <div class="post-single text-center offset-lg-2 mt-3">
        <div class="post-header mb-1">
           <h5>{{$image->description}}</h5>
            <div class="edit-links">
                <a href="" class="mr-2"><i class="fas fa-pen"></i></a>
                <a href=""><i class="fas fa-trash-alt"></i></a>
            </div>

        </div>


            <img src="{{ asset('images/' . $image->file_name) }}" width="700"  alt="{{$image->description}}">

        <div class="p-2">
            likes
        </div>
    </div>

@endsection
