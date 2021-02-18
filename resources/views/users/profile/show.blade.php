@extends('layouts.app')

@section('content')



<div class="card offset-lg-4 mt-4" style="width: 24rem">
    <div class="card-header">
        My profile
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">{{$user->name}}</li>
            <li class="list-group-item">{{$user->email}}</li>

        </ul>
        <form action="/upload" class="mt-4" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="image" id="image"
                       class="form-control-file input-file
                       @error('file_name') border-red @enderror"
                >
                <label for="image">
                <span class="btn btn-outline-secondary">
                     Upload avatar
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

@endsection
