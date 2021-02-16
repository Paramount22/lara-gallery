<?php

namespace App\Http\Controllers;
use App\Image;
use Illuminate\Http\Request;

class ImageUnlikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Image $image)
    {
        if( $image->unlikedBy($request->user() ) ) {
            return response(null, 409);
        }
        $image->unlikes()->create([
            'user_id' => $request->user()->id
        ]);

        return back()->with('flash', 'Unliked');

    }


}
