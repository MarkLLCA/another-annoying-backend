<?php

namespace App\Http\Controllers\Api;

use App\Models\Books;
use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function index()
    {
        // Fetch all books from the database 
        //the books:get() is a an sql query to ORM method
        $books = Books::get();
        if($books->count() > 0)
        {
            // return the books as a JSON response using the BooksResource
            return BooksResource::collection($books);
        }
        else
        {
            return response()->json(['message' => 'No books found'], 200);
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publication_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'All Fields are mandatory', 'error' => $validator->messages()], 422);
        }

        $books = Books::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'publication_date' => $request->publication_date,
        ]);

        return response()->json([
            'message' => 'Book created successfully',
            'book' => new BooksResource($books)
        ], 201); 



    }

    // Show a specific book by ID
    public function show(Books $book)
    {
        // Check if the book exists
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json([
            'book' => new BooksResource($book)
        ], 200);

        // return new BooksResource($book);
    }
    


    public function update(Books $book, Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publication_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'All Fields are mandatory', 'error' => $validator->messages()], 422);
        }

        // Update the book in the database
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'publication_date' => $request->publication_date,
        ]);

        return response()->json([
            'message' => 'Book updated successfully',
            'book' => new BooksResource($book)
        ], 200); 
    }


    public function destroy(Books $book)
    {
        // Delete the book from the database
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200); 
    }
}
