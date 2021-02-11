@extends('layouts.app')

@section('content')
    <div class="mt-4 col-lg-8 offset-lg-2">
        <div class="card animate__animated animate__fadeInDown">
            <div class="card-header">
                New posts
            </div>
            <div class="card-body">
                <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <input type="text" name="description" placeholder="describe your post"
                               class="form-control @error('description') border-red @enderror" id="desc"
                               value="{{ old('description') }}"
                        >
                        @error('description')
                        <div class="text-red mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="file" name="image" id="image"
                               class="form-control-file input-file
                                @error('file_name') border-red @enderror"
                        >
                        <label for="image">
                            <span class="btn btn-outline-secondary">
                                    Your image
                            </span>
                        </label>
                        @error('file_name')
                        <div class="text-red mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>



    </div>

@endsection
