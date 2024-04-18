@extends('layouts.app')

@section('content')
<body>
    <div class="container">
        <center><h1>Create Book</h1></center>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title"><h3>Title</h3></label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <br>
            <div class="form-group">
                <label for="author_ids"><h3>Authors</h3></label>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">
                        <h5>Choose or create author(s):</h5>
                    </label>
                    <div>
                        <input type="radio" id="existing_authors" name="author_choice" value="existing_authors" checked>
                        <label class="inline-block font-bold" for="existing_authors">-Choose existing author(s):</label>
                        <select name="author_ids[]" id="author_ids" class="border rounded py-2 px-3 ml-2" multiple>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <input type="radio" id="new_authors" name="author_choice" value="new_authors">
                        <label class="inline-block font-bold" for="new_authors">-Create new author(s):</label>
                        <input class="border rounded py-2 px-3 ml-2" type="text" name="new_author_names" id="new_author_names">
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group">
            <label for="genre_ids"><h3>Genres</h3></label>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                    <h5>Choose or create genre(s):</h5>
                </label>
                <div>
                    <input type="radio" id="existing_genres" name="genre_choice" value="existing_genres" checked>
                    <label class="inline-block font-bold" for="existing_genres">-Choose existing genre(s):</label>
                    <select name="genre_ids[]" id="genre_ids" class="border rounded py-2 px-3 ml-2" multiple>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2">
                    <input type="radio" id="new_genres" name="genre_choice" value="new_genres">
                    <label class="inline-block font-bold" for="new_genres">-Create new genre(s):</label>
                    <input class="border rounded py-2 px-3 ml-2" type="text" name="new_genre_names" id="new_genre_names">
                </div>
            </div>
        </div>
            <div class="form-group">
                <label for="publication_date"><h3>Publication Date:</h3></label>
                <input class="border rounded py-2 px-3" type="date" name="publication_date" id="publication_date" required>
            </div>
            <center>
            <div>
            <button type="submit" class="btn btn-success">Create Book</button>
            </div>
            </center>
        </form>
    </div>
</body>
@endsection
