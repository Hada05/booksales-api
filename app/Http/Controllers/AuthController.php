<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Setup validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);
        // Cek validator

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // Cek keberhasilan
        if ($user) {
            return response()->json([
                "success" => true,
                "message" => "User Registered Successfully",
                "data" => $user
            ], 201);
        } else {
            // Cek gagal
            return response()->json([
                "success" => false,
                "message" => "User Registration Failed",
            ], 409);
        }
    }

    public function login(Request $request)
    {
        // Setup Validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek Validator
        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        // Get Credentials
        $credentials = $request->only('email', 'password');

        // Cek isFailed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Login Failed: Invalid Credentials'
            ], 401);
        }

        // Cek isSuccess
        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'token' => $token,
            'user' => auth()->guard('api')->user(),
        ], 200);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'success' => true,
                'message' => 'Logout Successful'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'logout failed'
            ]);
        }
    }
}
