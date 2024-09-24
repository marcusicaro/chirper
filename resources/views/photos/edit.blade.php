@extends('layouts.app')

@section('content')
    <h1>Edit Photo</h1>
    <form action="{{ route('photos.update', $photo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $photo->title }}">
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ $photo->description }}</textarea>
        <button type="submit">Update</button>
    </form>
@endsection