<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AdoptionsExport;
use Maatwebsite\Excel\Facades\Excel;

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



    /**
     * Generate a PDF file
     */
    public function pdf()
    {
        $adoptions = Adoption::all();
        $pdf = Pdf::loadView('adoptions.pdf', compact('adoptions'));
        return $pdf->download('adoptions.pdf');
    }

    /**
     * Generate an Excel file
     */
    public function excel()
    {
        $adoptions = Adoption::all();
        return Excel::download(new AdoptionsExport, 'adoptions.xlsx');
    }

    public function search(Request $request)
    {
        $adopts = Adoption::names($request->q)->get();
        return view('adoptions.index')->with('adopts', $adopts)->with('searchQuery', $request->q);
    }
}