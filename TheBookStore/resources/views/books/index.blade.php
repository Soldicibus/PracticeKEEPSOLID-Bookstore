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

        footer{
            position: fixed;
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
        .modal-backdrop {
            z-index: -1;
        }
    </style>
</head>
<main class="table">
    <section class="table__header">
        <center>
        <h1>Books</h1>
        @if(Auth::check() && Auth::user()->role_id === 2)
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
            
            <a href="{{ route('books.export') }}" class="btn btn-info" style="margin-left: 10px;">Export Books</a>
        @endif
        <br></center>
    </section>
    <section class="table__body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author(s)</th>
                    <th>Genre(s)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>
                            @foreach($book->authors as $author)
                                {{ $author->name }}
                                @unless($loop->last)
                                    , <!-- Add a comma if it's not the last author -->
                                @endunless
                            @endforeach
                        </td>
                        <td>
                            @foreach($book->genres as $genre)
                                {{ $genre->name }}
                                @unless($loop->last)
                                    , <!-- Add a comma if it's not the last genre -->
                                @endunless
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                            @if(Auth::check() && Auth::user()->role_id === 2)
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-success" style="margin-left: 10px;">Edit</a>
                                <button type="button" class="btn btn-danger" style="margin-left: 10px;" data-toggle="modal" data-target="#deleteModal{{$book->id}}">
                                    Delete
                                </button>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$book->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{$book->id}}">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this book?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    </table>
</main>
@endsection
