<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;


class PetController extends Controller
{
    public function index(){
        $pets = Pet::all();
        return response()->json([
            "message"=> "✅ Query Succes!",
            "data"=> $pets,
            "status"=> "success",
            "status_code"=> 200
        ]);
    }

    public function show($id) {
        $pet = Pet::find($id);
        if($pet){
            return response()->json([
                "message"=> "✅ Query Succes!",
                "data"=> $pet,
                "status"=> "success",
                "status_code"=> 200
            ]);
        }else{
            return response()->json([
                "message"=> "❌ Query Not Found!",
                "data"=> null,
                "status"=> "error",
                "status_code"=> 404
            ]);
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'required',
                'kind' => 'required',
                'weight' => 'required',
                'age' => 'required',
                'breed' => 'required',
                'location' => 'required',
                'description' => 'required',
                'active' => 'required',
                'adopted' => 'required'
            ]);
            $pet = Pet::create($request->all());
            return response()->json([
                "message"=> "✅ Query Succes!",
                "data"=> $pet,
                "status"=> "success",
                "status_code"=> 200
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message"=> "❌ Something wrong!",
                "errors"=> $e->errors()
            ], 400);
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'required',
                'kind' => 'required',
                'weight' => 'required',
                'age' => 'required',
                'breed' => 'required',
                'location' => 'required',
                'description' => 'required',
                'active' => 'required',
                'adopted' => 'required'
            ]);
            $pet = Pet::find($id);
            if($pet){
                $pet->update($request->all());
                return response()->json([
                    "message"=> "✅ Query Succes!",
                    "data"=> $pet,
                    "status"=> "success",
                    "status_code"=> 200
                ]);
            }else{
                return response()->json([
                    "message"=> "❌ Query Not Found!",
                    "data"=> null,
                    "status"=> "error",
                    "status_code"=> 404
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message"=> "❌ Something wrong!",
                "errors"=> $e->errors()
            ], 400);
        }
    }

    public function destroy($id) {
        $pet = Pet::find($id);
        if($pet){
            $pet->delete();
            return response()->json([
                "message"=> "✅ Query Succes!",
                "data"=> null,
                "status"=> "success",
                "status_code"=> 200
            ]);
        }else{
            return response()->json([
                "message"=> "❌ Query Not Found!",
                "data"=> null,
                "status"=> "error",
                "status_code"=> 404
            ]);
        }
    }
}
