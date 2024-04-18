@extends('layouts.app')

@section('content')
    <h1>Books</h1>

    <a href="{{ route('books.create') }}">Add Book</a>
    <p></p>
<p>List of books:</p>
<ul>
        @foreach ($books as $book)
            <li>{{ $book->title }} by {{ $book->author->name }}</li>
        @endforeach
    </ul>
    <p></p>
<h2>Choose a Book to Edit</h2>

<form method="GET" action="{{ route('books.edit', ['book' => 1]) }}">
    <label for="book_id">Select a Book:</label>
    <select name="book_id" id="book_id">
        @foreach ($books as $book)
            <option value="{{ $book->id }}">{{ $book->title }}</option>
        @endforeach
    </select>

    <button type="submit">Edit Book</button>
</form>
@endsection
