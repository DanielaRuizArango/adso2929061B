<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
    try {    
        $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => '❌ invalid credentials'
            ], 401);
        }
        $token = Str::random(80);
        $user->update(['remember_token' => $token]);
        return response()->json([
            'message' => '✅ Login successful',
            'token' => $token,
            'user' => $user 
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => '❌ Something wrong!',
            'errors' => $e->errors()
        ], 400);
    }

}

public function logout(Request $request) {
    $token = $request->bearerToken(); 
    if (!$token) {
        return response()->json([
            'message' => '❌ Token not provided'
        ], 401);
    }
    $user = User::where('remember_token', $token)->first();
    if ($user) {
        $user->update(['remember_token' => null]);
        return response()->json([
            'message' => '✅ Logout successful'
        ], 200);
    } else {
        return response()->json([
            'message' => '❌ Invalid token'
        ], 401);
    }
}
}