<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $genre = Author::all(); // ambil semua data dari tabel genre
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "errors" => $validator->errors()
            ], 422);
        }

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo->store('authors', 'public');
            $photoName = $photo->hashName();
        }

        $author = Author::create([
            'name' => $request->name,
            'photo' => $photoName,
            'bio' => $request->bio
        ]);

        return response()->json([
            "success" => true,
            "message" => "Author Created Successfully",
            "data" => $author
        ], 201);
    }
}
