@extends('layouts.app')

@section('content')
<head>
    <script language='Javascript'>
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
        if (window.scrollY > 0) {
            navbar.classList.add('hidden');
        } else {
            navbar.classList.remove('hidden');
        }
        });
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .hidden {
            opacity: 0; 
            transition: opacity 0.3s ease-in-out;
        }

        footer{
            position: fixed;
        }

        body {
            min-height: 100vh;
            background: url('https://i.ibb.co/Qr5NKQ2/good-enough.png') center center/cover no-repeat;
            margin-top: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-position: center calc(var(--scroll-position));
        }

        main.table {
            width: 82vw;
            height: 90vh;
            background-color: #fff5;

            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            border-radius: .8rem;

            overflow:hidden;
        }

        .table__header {
            width: 100%;
            height: 16%;
            background-color: #fff4;
            padding: .8rem 1 1rem;
        }

        .table__body {
            width: 95%;
            max-height: calc(80% - .8rem);
            background-color: #fffb;

            margin: .8rem auto;
            border-radius: .6rem;
            overflow-x: auto;
            overflow-y: auto;
        }

        .table__body::-webkit-scrollbar {
            width: 0.5rem;
            height: 0.5rem;
        }

        .table__body::-webkit-scrollbar-thumb {
            border-radius: .5rem;
            background-color: #0004;
            visibility: hidden;
        }

        .table__body:hover::-webkit-scrollbar-thumb {
            visibility: visible;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            padding: 1rem;
            table-layout: fixed;
        }

        th, td {
            text-align: center;
            width: 100%;
        }

        tbody tr:nth-child(even) {
            background-color: #0000000b;
        }

        tbody tr:hover {
            background-color: #fff6;
        }

        thead th {
            position: sticky;
            top:0;
            left:0;
            background-color: #d5d1defe;
        }
    </style>
</head>
<main class="table">
    <section class="table__header">
        <center><h1>Favorites</h1></center>
        @if($books->isNotEmpty())
    </section>
    <section class="table__body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>@foreach($book->authors as $author)
                                {{ $author->name }}
                                @unless($loop->last)
                                    , <!-- Add a comma if it's not the last author -->
                                @endunless
                            @endforeach</td>
                        <td>@foreach($book->genres as $genre)
                                {{ $genre->name }}
                                @unless($loop->last)
                                    , <!-- Add a comma if it's not the last genre -->
                                @endunless
                            @endforeach</td>
                        <td>{{ $book->publication_date }}</td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                            <form action="{{ route('favorites.destroy', $book->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </section>
    </table>
</main>
    @else
    <p>No favorite books found.</p>
    @endif
@endsection
