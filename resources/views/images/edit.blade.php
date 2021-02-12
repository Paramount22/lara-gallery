@extends('layouts.app')

@section('content')
    <div class="mt-4 col-lg-8 offset-lg-2">
        <div class="card animate__animated animate__fadeInDown">
            <div class="card-header">
               Edit your post
            </div>
            <div class="card-body">
                <form action="{{route('post.update', $image->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <input type="text" name="description" placeholder="describe your post"
                               class="form-control @error('description') border-red @enderror" id="desc"
                               value="{{ $image->description }}"
                        >
                        @error('description')
                        <div class="text-red mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div> Current picture: {{ $image->file_name }}</div>
                        <div class="mb-2 mt-3">
                            <label>
                                <div class="input-group-text">
                                     <div class="remove">Remove image ? </div>
                                    <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                            </label>
                        </div>
                        <input type="file" name="image" id="image"
                               class="form-control-file input-file
           @error('file_name') border-red @enderror"
                               value="{{ $image->image }}"
                        >
                                    <label for="image">
                    <span class="btn btn-outline-secondary mt-3">
                        New image
                    </span>
                        </label>
                        @error('file_name')
                        <div class="text-red mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                        <button type="submit" class="btn btn-primary">Edit</button>

                </form>
            </div>

        </div>



    </div>

@endsection
