<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
// PDF
use Barryvdh\DomPDF\Facade\Pdf;
// Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PetsExport;
use App\Imports\PetsImport;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::orderBy('id', 'desc')->paginate(12);
        return view('pets.index')->with('pets', $pets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'kind' => ['required', 'string'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'breed' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
            'active' => ['required'],
            'adopted' => ['required'],
        ]);

        $pet = new Pet;
        $pet->name = $request->name;
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/pets'), $imageName);
            $pet->image = 'images/pets/'.$imageName;
        }
        $pet->kind = $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->breed = $request->breed;
        $pet->location = $request->location;
        $pet->description = $request->description;
        $pet->active = $request->active;
        $pet->adopted = $request->adopted;

        if($pet->save()) {
            return redirect('pets')
                    ->with('message', 'The Pet: '.$pet->name.' was added successful!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        return view('pets.edit')->with('pet', $pet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'kind' => ['required', 'string'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'breed' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
            'active' => ['required'],
            'adopted' => ['required'],
        ]);

        $pet->name = $request->name;
        if($request->hasFile('image')) {
            // Delete old image
            if($pet->image != 'images/no-image.png' && file_exists(public_path($pet->image))) {
                unlink(public_path($pet->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/pets'), $imageName);
            $pet->image = 'images/pets/'.$imageName;
        }
        $pet->kind = $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->breed = $request->breed;
        $pet->location = $request->location;
        $pet->description = $request->description;
        $pet->active = $request->active;
        $pet->adopted = $request->adopted;

        if($pet->save()) {
            return redirect('pets')
                    ->with('message', 'The Pet: '.$pet->name.' was updated successful!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        if($pet->image != 'no-image.png' && file_exists(public_path($pet->image))) {
            unlink(public_path($pet->image));
        }
        if($pet->delete()) {
            return redirect('pets')
                    ->with('message', 'The Pet: '.$pet->name.' was deleted successful!');
        }
    }

     /**
     * Generate PDF file
     */
        
    public function pdf() {
        $pets = Pet::all();
        $pdf = Pdf::loadView('pets.pdf', compact('pets'));
        return $pdf->download('allpets.pdf');
    }

    /**
     * Generate Excel file
     */
    public function excel() {
        return Excel::download(new PetsExport, 'allpets.xlsx');
    }

    /**
     * Import Excel file
     */
    public function import(Request $request) {
        $file = $request->file('file');
        Excel::import(new PetsImport, $file);
        return redirect('pets')->with('message', 'Pets imported successfully!');
    }

    /**
     * Search pets
     */
    public function search(Request $request) {
        $pets= Pet::names($request->q)->orderBy('id', 'desc')->paginate(12);
        return view('pets.search')->with('pets', $pets);
        // $query = $request->q;
        // $users = User::where('fullname', 'like', '%'.$query.'%')
        //             ->orWhere('document', 'like', '%'.$query.'%')
        //             ->orWhere('email', 'like', '%'.$query.'%')
        //             ->get();
        // return view('users.index')->with('users', $users);
    }
}