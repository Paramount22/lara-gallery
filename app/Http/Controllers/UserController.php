<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $this->authorize('can-edit-user', $user); // gate v subore auth service prvider

        return view('users.profile.show', [
           'user' => $user
        ]);
    }

    public function store(Request $request)
    {
            if($request->hasFile('image')) {
                $filename = $request->image->getClientOriginalName();
                $request->image->storeAs('images', $filename, 'public' );
                auth()->user()->update(['file_name' => $filename]);
            }

        return back()->with('flash', 'Uploded');

    }







}
