<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        $images = $user->images()->latest()->with('user', 'likes')->paginate(9);
       return view('users.images.index', [
            'user' => $user,
           'images' => $images
       ]);
    }
}
