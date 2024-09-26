<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;

class PhotoCommentController extends Controller
{
    public function index(Photo $photo)
    {
        $comments = $photo->comments;
        return view('comments.index', compact('photo', 'comments'));
    }

    public function create(Photo $photo)
    {
        return view('comments.create', compact('photo'));
    }

    public function store(Request $request, Photo $photo)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $photo->comments()->create($request->except('_token'));

        return redirect()->route('photos.comments.index', $photo->id)
                         ->with('success', 'Comment added successfully.');
    }

    public function show(Photo $photo, Comment $comment)
    {
        return view('comments.show', compact('photo', 'comment'));
    }

    public function edit(Photo $photo, Comment $comment)
    {
        return view('comments.edit', compact('photo', 'comment'));
    }

    public function update(Request $request, Photo $photo, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->update($request->all());

        return redirect()->route('photos.comments.index', $photo->id)
                         ->with('success', 'Comment updated successfully.');
    }

    public function destroy(Photo $photo, Comment $comment)
    {
        $comment->delete();

        return redirect()->route('photos.comments.index', $photo->id)
                         ->with('success', 'Comment deleted successfully.');
    }
}