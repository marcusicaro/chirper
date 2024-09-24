@extends('layouts.app')

@section('content')
    <h1>Photos</h1>
    <a href="{{ route('photos.create') }}">Create New Photo</a>
    <ul>
        @foreach ($photos as $photo)
            <li>
                <a href="{{ route('photos.show', $photo->id) }}">{{ $photo->title }}</a>
                <a href="{{ route('photos.edit', $photo->id) }}">Edit</a>
                <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection