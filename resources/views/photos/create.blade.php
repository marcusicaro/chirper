@extends('layouts.app')

@section('content')
    <h1>Create Photo</h1>
    <form action="{{ route('photos.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        <button type="submit">Create</button>
    </form>
@endsection