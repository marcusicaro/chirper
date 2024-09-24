@extends('layouts.app')

@section('content')
    <h1>Add Comment</h1>
    <form action="{{ route('photos.comments.store', $photo->id) }}" method="POST">
        @csrf
        <label for="content">Content:</label>
        <input type="text" name="content" id="content">
        <button type="submit">Add Comment</button>
    </form>
@endsection