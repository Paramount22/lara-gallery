<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'image_id' => 'required|integer|exists:images,id'
        ]);
        // priamo do userovych komenarov vytvorime dalsi koment, vdaka vztahom v user modely (hasMany)
        $comment =  auth()->user()->comments()->create( $request->all() );

        return redirect('posts/' . $comment->image->id . '#comments')
            ->with('flash', 'CommentAdded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * @param Request $request
     * @param Comment $comment
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->text = $request->text;

        $comment->save();
    }


    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->delete();
        return back()->with('flash', 'Deleted');
    }
}
