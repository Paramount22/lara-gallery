@extends('layouts.app')

@section('content')
    <div class="posts-images mt-4">


            @foreach($images as $image)

                    <div class="picture animate__animated animate__fadeInLeft">
                        <a href="">
                        <img src="{{ asset('images/' . $image->file_name) }}" class="card-img-top"
                             alt="{{$image->description}}">
                        </a>
                    </div>


            @endforeach



        </div>

@endsection
