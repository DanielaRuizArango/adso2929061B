<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        $users = User::all();
        return response()->json([
            "message"=> "Query Succes!",
            "data"=> $users,
            "status"=> "success",
            "status_code"=> 200
        ]);
    }
}
