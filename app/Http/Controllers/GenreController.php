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

    public function show(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Resource Not Found',
                ],
                404
            );
        } else {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Get Detail Resource',
                    'data' => $genre,
                ],
                200
            );
        }
    }

    public function update(string $id, Request $request)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Not Found',
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $genre->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Resource Updated Successfully',
            'data' => $genre
        ], 200);
    }


    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Resource Not Found',
                ],
                404
            );
        } else {
            $genre->delete();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Resource Deleted Successfully',
                ],
                200
            );
        }
    }
}
