@extends('layouts.app')

@section('content')


    <section class="post-single text-center offset-lg-2 mt-3">
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


            <img src="{{ asset('images/' . $image->file_name) }}"  alt="{{$image->description}}">

        <div class="p-2 image-footer">
            <div class="author">
                <a href=""> @<span>{{$image->user->name}}</span></a>
            </div>
            <div class="likes">likes</div>
        </div>
    </section>

    <section class="comments" id="comments">
        @auth()
            <form action="{{route('comments.store')}}" method="POST" class="add-comment-form offset-lg-2">
                @csrf

                <label for="comment-area"> </label>
                <textarea name="text" placeholder="insert your comment" required=""
                          class="form-control" id="comment-area"  rows="2">
                </textarea>

                <button class="btn btn-sm btn-secondary mt-3" type="submit">Add comment</button>
                <input type="hidden" name="image_id" value="{{ $image->id }}">
            </form>
        @endauth

            <ol class="comments-list offset-lg-2">
                @foreach($image->comments as $comment)
                    <li>
                        <article class="comment">
                            <div class="content">
                                {{ $comment->text }}
                            </div>
                            <footer class="meta">
                                <div class="meta-info">
                                    <a href="{{ url('user/'. $comment->user->id) }}" class="author">
                                        @<span>{{ $comment->user->name }}</span>
                                    </a>
                                    <time datetime="{{ $comment->created_at->toW3cString() }}" class="text-muted">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </time>
                                </div>

                                @can('update', $comment)
                                   <div class="edit-comment">
                                       <a href="" class="edit-comment"
                                          title="Edit" ><i class="fa fa-pen mr-1"></i></a>
                                       <a href="{{ url('comment/' . $comment->id . '/delete') }}"
                                          class="delete-comment"
                                          title="Delete" ><i class="fas fa-trash-alt"></i></a>
                                   </div>
                                @endcan


                            </footer>
                        </article>
                    </li>
                @endforeach
            </ol>



    </section>

@endsection
