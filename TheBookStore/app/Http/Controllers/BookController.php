<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use League\Csv\Writer;

class BookController extends Controller
{
    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'genres'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'publication_date' => 'required|date',
            // Add any other validation rules as needed
        ]);
    
        $book = new Book();
        $book->title = $validatedData['title'];
        $book->publication_date = $validatedData['publication_date'];
    
        $book->save();
    
        // Handle authors input
        $authorIds = $request->input('author_ids', []);
        $newAuthorNames = $request->input('new_author_names', '');
        $newAuthorNamesArray = explode(',', $newAuthorNames);
        $newAuthorIds = [];
    
        // Create new authors if provided
        if (!empty($newAuthorNamesArray[0])) {
            foreach ($newAuthorNamesArray as $newAuthorName) {
                $author = Author::create(['name' => $newAuthorName]);
                $newAuthorIds[] = $author->id;
            }
        }
    
        // Merge existing and new author IDs
        $authorIds = array_merge($authorIds, $newAuthorIds);
    
        // Update authors associated with the book
        $book->authors()->sync($authorIds);
    
        // Handle genres input
        $genreIds = $request->input('genre_ids', []);
        $newGenreNames = $request->input('new_genre_names', '');
        $newGenreNamesArray = explode(',', $newGenreNames);
        $newGenreIds = [];
    
        // Create new genres if provided
        if (!empty($newGenreNamesArray[0])) {
            foreach ($newGenreNamesArray as $newGenreName) {
                $genre = Genre::create(['name' => $newGenreName]);
                $newGenreIds[] = $genre->id;
            }
        }
    
        // Merge existing and new genre IDs
        $genreIds = array_merge($genreIds, $newGenreIds);
    
        // Update genres associated with the book
        $book->genres()->sync($genreIds);
    
        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();

        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'publication_date' => 'required|date',
            // Add any other validation rules as needed
        ]);
    
        $book->title = $request->input('title');
        $book->publication_date = $request->input('publication_date');
    
        // Handle authors input
        $authorIds = $request->input('author_ids', []);
        $newAuthorNames = $request->input('new_author_names', '');
        $newAuthorNamesArray = explode(',', $newAuthorNames);
        $newAuthorIds = [];
    
        // Create new authors if provided
        if (!empty($newAuthorNamesArray[0])) {
            foreach ($newAuthorNamesArray as $newAuthorName) {
                $author = Author::create(['name' => $newAuthorName]);
                $newAuthorIds[] = $author->id;
            }
        }
    
        // Merge existing and new author IDs
        $authorIds = array_merge($authorIds, $newAuthorIds);
    
        // Update authors associated with the book
        $book->authors()->sync($authorIds);
    
        // Handle genres input
        $genreIds = $request->input('genre_ids', []);
        $newGenreNames = $request->input('new_genre_names', '');
        $newGenreNamesArray = explode(',', $newGenreNames);
        $newGenreIds = [];
    
        // Create new genres if provided
        if (!empty($newGenreNamesArray[0])) {
            foreach ($newGenreNamesArray as $newGenreName) {
                $genre = Genre::create(['name' => $newGenreName]);
                $newGenreIds[] = $genre->id;
            }
        }
    
        // Merge existing and new genre IDs
        $genreIds = array_merge($genreIds, $newGenreIds);
    
        // Update genres associated with the book
        $book->genres()->sync($genreIds);
    
        // Save the updated book
        $book->save();
    
        return redirect()->route('books.show', ['book' => $book->id]);
    }

    public function destroy(Book $book)
    {
        $book->authors()->detach();

        $book->genres()->detach();

        $book->delete();
    
        return redirect()->route('books.index');
    }
    public function export()
    {
        $books = Book::with('authors', 'genres')->get(); // Eager load authors and genres
    
        $csv = Writer::createFromString('');
    
        $csv->insertOne(['Title', 'Publication Date', 'Authors', 'Genres']);
    
        foreach ($books as $book) {
            $authors = $book->authors->pluck('name')->implode(', '); // Get comma-separated list of author names
            $genres = $book->genres->pluck('name')->implode(', '); // Get comma-separated list of genre names
            $csv->insertOne([$book->title, $book->publication_date, $authors, $genres]);
        }
    
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="books.csv"');
        echo $csv->getContent();
    }
    
}
