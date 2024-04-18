@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <center><h1>Edit Book</h1></center>
        <p></p>
        <form method="POST" action="{{ route('books.update', $book->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="title">
                    <h3>Title</h3>
                </label>
                <input class="form-control" type="text" name="title" id="title" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
    <label for="author_ids"><h3>Authors</h3></label>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">
            <h5>Choose or create author(s):</h5>
        </label>
        <div>
            <input type="radio" id="existing_authors" name="author_choice" value="existing_authors" checked>
            <label class="inline-block font-bold" for="existing_authors">-Choose existing author(s):</label>
            <select name="author_ids[]" id="author_ids" class="border rounded py-2 px-3 ml-2" multiple required>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ in_array($author->id, $book->authors->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mt-2">
            <input type="radio" id="new_author" name="author_choice" value="new_author">
            <label class="inline-block font-bold" for="new_author">-Create new author:</label>
            <input class="border rounded py-2 px-3 ml-2" type="text" name="new_author_names" id="new_author_names">
        </div>
    </div>
</div>
            <div class="form-group">
                <label for="genre_ids"><h3>Genres</h3></label>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">
                        <h5>Choose or create genre(s):</h5>
                    </label>
                    <div>
                        <input type="radio" id="existing_genres" name="genre_choice" value="existing_genres" checked>
                        <label class="inline-block font-bold" for="existing_genres">-Choose existing genre(s):</label>
                        <select name="genre_ids[]" id="genre_ids" class="border rounded py-2 px-3 ml-2" multiple required>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ in_array($genre->id, $book->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <input type="radio" id="new_genre" name="genre_choice" value="new_genre">
                        <label class="inline-block font-bold" for="new_genre">-Create new genre:</label>
                        <input class="border rounded py-2 px-3 ml-2" type="text" name="new_genre_names" id="new_genre_names">
                    </div>
                </div>
            </div>
            <p></p>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="publication_date">
                <h3>Publication Date:</h3>
                </label>
                <input class="border rounded py-2 px-3" type="date" name="publication_date" id="publication_date" value="{{ $book->publication_date }}" required>
            </div>
        </div>
            <center>
                <div>
                <button type="submit" class="btn btn-success">Update Book</button>
                </div>
            </center>
        </form>
    </div>
@endsection
