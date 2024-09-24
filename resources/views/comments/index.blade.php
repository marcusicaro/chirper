@extends('layouts.app')

@section('content')
    <h1>Comments for Photo: {{ $photo->title }}</h1>
    <a href="{{ route('photos.comments.create', $photo->id) }}">Add Comment</a>
    <ul>
        @foreach($comments as $comment)
            <li>
                {{ $comment->content }} 
                - <a href="{{ route('photos.comments.edit', [$photo->id, $comment->id]) }}">Edit</a>
                - <form action="{{ route('photos.comments.destroy', [$photo->id, $comment->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection