<div class="posts-images mt-4 mb-4">
    @forelse($images as $image)
        <div class="picture animate__animated animate__fadeInLeft">
            <a href="{{route('posts.show', $image->id)}}">
                <img src="{{ asset('images/' . $image->file_name) }}" class="card-img-top"
                     alt="{{$image->description}}">
                <div class="middle">
                    <div class="stats">
                        <div class="likes-count">
                            <i class="fas fa-heart"></i> {{ $image->likes->count() }}
                        </div>
                        <div class="comments-count">
                            <i class="fas fa-comment"></i> {{ $image->comments->count() }}
                        </div>

                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="alert alert-info" role="alert">
            <div class="alert alert-info" role="alert">
                No posts yet !
            </div>
        </div>
    @endforelse
</div>

{{ $images->links() }}
