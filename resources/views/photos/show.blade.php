@extends('layouts.app')

@section('content')
    <h1>{{ $photo->title }}</h1>
    <p>{{ $photo->description }}</p>
    <a href="{{ route('photos.edit', $photo->id) }}">Edit</a>
    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('asd') }}">Back to Photos</a>
@endsection