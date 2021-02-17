<div class="posts-images mt-4 mb-4">
    @forelse($images as $image)
        <div class="picture animate__animated animate__fadeInLeft">
            <a href="{{route('posts.show', $image->id)}}">
                <img src="{{ asset('images/' . $image->file_name) }}" class="card-img-top"
                     alt="{{$image->description}}">
            </a>
        </div>
    @empty
        <div class="alert alert-info" role="alert">
            <div class="alert alert-info" role="alert">
                A simple info alert—check it out!
            </div>
        </div>
    @endforelse
</div>

{{ $images->links() }}
