@extends('layouts.app')

@section('content')


    <section class="post-single text-center offset-lg-3 mt-3">
        <div class="post-header mb-1">
           <h5>{{$image->description}}</h5>

            @can('update', $image)
                <div class="edit-links">
                    <form action="{{route('post.destroy', $image) }}" method="post">
                        @csrf
                        @method('DELETE')
                    <a href="{{route('post.edit', $image)}}" class="mr-2"><i class="fas fa-pen"></i></a>

                        <button  type="submit" class="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
            @endcan

        </div>
            <img src="{{ asset('images/' . $image->file_name) }}" alt="{{$image->description}}">

        <div class="p-2 image-footer">
            <div class="author">
                <a href=""> @<span>{{$image->user->name}}</span></a>
            </div>
            <div class="likes">
                @auth
                    @if(! $image->likedBy( auth()->user() ))
                        <form action="{{route('posts.likes', $image->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success mr-1">
                                <i class="fas fa-thumbs-up"></i>
                            </button>
                        </form>
                    @endif

                    @if(! $image->unlikedBy( auth()->user() ))
                            <form action="{{route('posts.unlikes', $image->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-thumbs-down"></i>
                                </button>
                            </form>
                    @endif



                @endauth
                    @if($image->likes->count() > 0)
                        <div class="like mr-1">
                            <strong class="ml-1">{{$image->likes->count()}}
                                <i class="fas fa-thumbs-up "></i>
                            </strong>
                        </div>
                    @endif
                    @if($image->unlikes->count() > 0)
                        <div class="unlike">
                            <strong>{{$image->unlikes->count()}}
                                <i class="fas fa-thumbs-down"></i>
                            </strong>
                        </div>
                    @endif
            </div>
        </div>
    </section>

    @include('_partials.comments')


@endsection
