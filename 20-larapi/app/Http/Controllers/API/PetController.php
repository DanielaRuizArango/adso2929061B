<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        try {
            $pet = Pet::findOrFail($id); 
            
            return response()->json([
                "message" => "✅ Query Success!",
                "data" => $pet,
                "status" => "success",
                "status_code" => 200
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "message" => "❌ Mascota no encontrada!",
                "data" => null,
                "status" => "error",
                "status_code" => 404
            ], 404);
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'kind' => 'required',
                'weight' => 'required|numeric|min:0',
                'age' => 'required|integer|min:0',
                'breed' => 'required',
                'location' => 'required',
                'description' => 'required',
                'active' => 'required|boolean',
                'adopted' => 'required|boolean',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'
            ]);

            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('pets', 'public');
            }

            $pet = Pet::create($data);
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
                'name' => 'sometimes|required',
                'kind' => 'sometimes|required',
                'weight' => 'sometimes|required|numeric|min:0',
                'age' => 'sometimes|required|integer|min:0',
                'breed' => 'sometimes|required',
                'location' => 'sometimes|required',
                'description' => 'sometimes|required',
                'active' => 'sometimes|required|boolean',
                'adopted' => 'sometimes|required|boolean',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'
            ]);
            $pet = Pet::findOrFail($id);

            $data = $request->except('image');

            if ($request->hasFile('image')) {
                if ($pet->image) {
                    Storage::disk('public')->delete($pet->image);
                }

                $data['image'] = $request->file('image')->store('pets', 'public');
            }

            $pet->update($data);

            return response()->json([
                "message" => "✅ ¡Mascota '{$pet->name}' actualizada con éxito!",
                "data" => $pet,
                "status" => "success",
                "status_code" => 200
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "message" => "❌ ¡Mascota no encontrada!",
                "data" => null,
                "status" => "error",
                "status_code" => 404
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "message" => "❌ ¡Campos inválidos!",
                "errors" => $e->errors()
            ], 400);
        }
    }

    public function destroy($id) {
        try {
            $pet = Pet::findOrFail($id);
            $petName = $pet->name;
            $pet->delete();

            return response()->json([
                "message" => "✅ ¡Mascota '{$petName}' eliminada con éxito!",
                "data" => null,
                "status" => "success",
                "status_code" => 200
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "message" => "❌ ¡Mascota no encontrada!"
            ], 404);
        }
    }
}
