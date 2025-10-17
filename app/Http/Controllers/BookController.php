<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all(); // ambil semua data dari tabel books
        return response()->json([
            "success" => true,
            "message" => "Get All Resources",
            "data" => $books
        ], 200);
    }
}