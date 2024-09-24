@extends('layouts.app')

@section('content')
    <h1>Edit Comment</h1>
    <form action="{{ route('photos.comments.update', [$photo->id, $comment->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="content">Content:</label>
        <input type="text" name="content" id="content" value="{{ $comment->content }}">
        <button type="submit">Update Comment</button>
    </form>
@endsection