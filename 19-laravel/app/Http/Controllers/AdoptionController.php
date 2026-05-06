<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adopts = Adoption::all();
        return view('adoptions.index')->with('adopts', $adopts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        // Only get pets that are active and not yet adopted
        $pets = Pet::where('active', 1)->where('status', 0)->get();
        return view('adoptions.create')->with('users', $users)->with('pets', $pets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'pet_id'  => 'required'
        ]);

        $adoption = new Adoption();
        $adoption->user_id = $request->user_id;
        $adoption->pet_id  = $request->pet_id;

        if ($adoption->save()) {
            $pet = Pet::find($request->pet_id);
            if ($pet) {
                $pet->status = 1; 
                $pet->save();
            }
            return redirect('adoptions')->with('message', 'The adoption was created successfully!');
        }
    }
    
    public function show(Adoption $adoption)
    {
        return view('adoptions.show')->with('adopt', $adoption);
    }



    public function pdf()
    {
        // Implement PDF export
        $adopts = Adoption::all();
    }

    public function excel()
    {
        // Implement Excel export
    }

    public function search(Request $request)
    {
        // Implement Search
        $adopts = Adoption::whereHas('pet', function($q) use ($request) {
            $q->where('name', 'like', "%" . $request->qsearch . "%");
        })->orWhereHas('user', function($q) use ($request) {
            $q->where('fullname', 'like', "%" . $request->qsearch . "%");
        })->get();
        return view('adoptions.search')->with('adopts', $adopts);
    }
}