<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all(); // ambil semua data dari tabel books
        if ($books->isEmpty()) {
            return response()->json([
                "success" => false,
                "message" => "No Resources Found",
                "data" => []
            ], 404);
        } else {
            return response()->json([
                "success" => true,
                "message" => "Get All Resources",
                "data" => $books
            ], 200);
        }
    }

    public function store(Request $request)
    {
        //1. validator
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        //2. cek validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        //3. upload image
        $image = $request->file('cover_photo');
        $image->store('books', 'public');


        //4. simpan ke database
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
            'stock' => $request->stock
        ]);

        //5. return response
        return response()->json([
            'success' => true,
            'message' => 'Book Created Successfully',
            'data' => $book
        ], 201);
    }
}