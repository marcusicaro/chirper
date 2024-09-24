<?php
namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        $photo = new Photo();
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->save();

        return redirect()->route('photos.index');
    }

    public function show(Photo $photo)
    {
        return view('photos.show', compact('photo'));
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('photos.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->save();

        return redirect()->route('photos.index');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return redirect()->route('photos.index');
    }
}