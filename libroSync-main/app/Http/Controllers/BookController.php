<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $books = Book::paginate($perPage);
        return response()->json($books);
    }

    public function borrow($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $borrowedBooks = Session::get('borrowed_books', []);
        if (in_array($id, $borrowedBooks)) {
            return response()->json(['message' => 'Book already borrowed'], 400);
        }
        if ($book->stock <= 0) {
            return response()->json(['message' => 'Book not available'], 400);
        }
        $book->stock -= 1;
        $book->save();
        $borrowedBooks[] = $id;
        Session::put('borrowed_books', $borrowedBooks);
        return response()->json(['message' => 'Book borrowed successfully']);
    }

    public function returnBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $borrowedBooks = Session::get('borrowed_books', []);
        if (!in_array($id, $borrowedBooks)) {
            return response()->json(['message' => 'Book not borrowed'], 400);
        }
        $book->stock += 1;
        $book->save();
        $borrowedBooks = array_diff($borrowedBooks, [$id]);
        Session::put('borrowed_books', array_values($borrowedBooks));
        return response()->json(['message' => 'Book returned successfully']);
    }

    public function borrowed()
    {
        $borrowedBooks = Session::get('borrowed_books', []);
        $books = Book::whereIn('id', $borrowedBooks)->get();
        return response()->json($books);
    }
}
