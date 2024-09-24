@extends('layouts.app')

@section('content')
    <h1>Comment Details</h1>
    <p>{{ $comment->content }}</p>
    <a href="{{ route('photos.comments.edit', [$photo->id, $comment->id]) }}">Edit</a>
@endsection