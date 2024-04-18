@extends('layouts.app')

@section('content')
    <h1>Delete Book</h1>

    <form method="POST" action="{{ route('books.destroy', $book->id) }}">
        @csrf
        @method('DELETE')

        <p>Are you sure you want to delete the book "{{ $book->title }}"?</p>

        <button type="submit">Yes, delete this book</button>
        <a href="{{ route('books.index') }}">Cancel</a>
    </form>
@endsection
