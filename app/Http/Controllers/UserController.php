<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Storage;


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

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('can-edit-user', $user); // gate v subore auth service provider

        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            if (isset(auth()->user()->file_name)) {
                Storage::disk('public')->delete('/images/' . auth()->user()->file_name);

                $request->image->storeAs('images', $filename, 'public');
                auth()->user()->update(['file_name' => $filename]);
            }

            return back()->with('flash', 'Uploded');
        }


    }






}
