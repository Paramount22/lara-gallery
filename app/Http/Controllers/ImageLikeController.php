<?php

namespace App\Http\Controllers;
use App\Image;
use Illuminate\Http\Request;

class ImageLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Image $image)
    {
        if( $image->likedBy($request->user() ) ) {
            return response(null, 409);
        }
        $image->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return redirect('/posts/' . $image->id . '/#comments')->with('flash', 'Liked');

    }
}
