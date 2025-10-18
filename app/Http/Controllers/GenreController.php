<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index()
    {
        $genre = Genre::all(); // ambil semua data dari tabel genre
        if ($genre->isEmpty()) {
            return response()->json([
                "success" => false,
                "message" => "No Resources Found",
                "data" => []
            ], 404);
        } else {
            return response()->json([
                "success" => true,
                "message" => "Get All Resources",
                "data" => $genre
            ], 200);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "errors" => $validator->errors()
            ], 422);
        }

        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            "success" => true,
            "message" => "Genre Created Successfully",
            "data" => $genre
        ], 201);
    }
}
