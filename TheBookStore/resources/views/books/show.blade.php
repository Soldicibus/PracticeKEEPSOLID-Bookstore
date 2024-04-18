@extends('layouts.app')

@section('content')
<head>
        <style>
            .container_show {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #0005;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        footer{
            position: fixed;
        }
        </style>
    </head>
<div class="container_show py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <h1>{{ $book->title }}</h1>
            <hr>
            <p><strong>Author:</strong>@foreach($book->authors as $author)
                                        {{ $author->name }}
                                        @unless($loop->last)
                                            , <!-- Add a comma if it's not the last author -->
                                        @endunless
                                    @endforeach</p>
            <p><strong>Genre:</strong>@foreach($book->genres as $genre)
                                    {{ $genre->name }}
                                    @unless($loop->last)
                                        , <!-- Add a comma if it's not the last genre -->
                                    @endunless
                                @endforeach</p>
            <p><strong>Publication Date:</strong> {{ $book->publication_date }}</p>

            <div class="d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('books.index') }}" class="btn btn-primary me-3" style="margin-left: 10px;">Back to Books</a>

                @if (Auth::check())
                    <a href="{{ route('favorites.index') }}" class="btn btn-success" style="margin-left: 10px;">To My Favorites</a>
                @endif
                @if (Auth::check() && auth()->user()->favorites->contains($book))
                    <p class="mt-3"><span class="btn btn-warning disabled" style="margin-left: 10px;">Already in Favorites</span></p>
                @elseif (Auth::check())
                    <form action="{{ route('favorites.store', $book->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="btn btn-warning" style="margin-left: 10px;">Add to Favorites</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    hr {
        border: none;
        border-top: 1px solid #ccc;
        margin: 30px 0;
    }
</style>
@endsection
