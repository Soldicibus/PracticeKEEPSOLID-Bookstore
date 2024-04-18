<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function index()
    {
        return view('favorites', [
            'books' => auth()->user()->favorites
        ]);
    }
    
    public function store(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
    
        $favorite = new Favorite();
        $favorite->user_id = auth()->user()->id;
        $favorite->book_id = $book->id;
        $favorite->save();
    
        return back()->with('success', 'Book added to favorites.');
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        auth()->user()->favorites()->detach($book);
    
        return redirect()->route('favorites.index')
            ->with('success', 'Book removed from favorites.');
    }

}
?>