<section class="comments" id="comments">

    @auth()
        <form action="{{route('comments.store')}}" method="POST" class="add-comment-form offset-lg-3">
            @csrf

            <label for="comment-area"> </label>
            <textarea name="text" placeholder="insert your comment" required=""
                      class="form-control" id="comment-area"  rows="2">
                </textarea>

            <button class="btn btn-sm btn-secondary mt-3" type="submit">Add comment</button>
            <input type="hidden" name="image_id" value="{{ $image->id }}">
        </form>
    @endauth

    <ol class="comments-list offset-lg-3">
        @if($image->comments->count() > 0)
            <span class="btn btn-info btn-sm mb-3">
                      {{$image->comments->count()}}
                {{ Str::plural('comment', $image->comments->count())  }}
                  </span>
        @endif
        @foreach($image->comments as $comment)
            <li>
                @include('_partials.showComments')
            </li>
        @endforeach
    </ol>



</section>
