<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// PDF
use Barryvdh\DomPDF\Facade\Pdf;
// Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $users = User::orderBy('id', 'desc')->paginate(12);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'document'      => ['required', 'numeric', 'unique:'.User::class],
            'fullname'      => ['required', 'string'],
            'gender'        => ['required'],
            'birthdate'     => ['required', 'date'],
            'photo'         => ['required', 'image'],
            'phone'         => ['required', 'string'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'unique:'.User::class],
            'password'      => ['required', 'confirmed'],
        ]);

        if($validation) {
            // dd($request->all());
            if($request->hasFile('photo')) {
                $photo = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('photos/users'), $photo);
            }
        }

        $user = new User;
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = 'photos/users/'.$photo;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if($user->save()) {
            return redirect('users')
                    ->with('message', 'The User: '.$user->fullname.' was added successful!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // dd($user->toArray());
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'document'      => ['required', 'unique:'.User::class.',document,'.$user->id],
            'fullname'      => ['required', 'string'],
            'gender'        => ['required'],
            'birthdate'     => ['required', 'date'],
            'photo'         => ['nullable', 'image'],
            'phone'         => ['required', 'string'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'unique:'.User::class.',email,'.$user->id],
        ]);

        if($request->hasFile('photo')) {
            //dd($request->all());
            $photo = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('photos'), $photo);
            //Delete old photo
            if($request->originphoto != 'no-photo.png' && file_exists(public_path($request->originphoto))) {
                unlink(public_path($request->originphoto));
            }
        } else{
            $photo = $request->originphoto;
        }

        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->photo = $photo;

        if($user->save()) {
            return redirect('users')
                    ->with('message', 'The User: '.$user->fullname.' was updated successful!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->photo != 'no-photo.png' && file_exists(public_path($user->photo))) {
            unlink(public_path($user->photo));
        }
        if($user->delete()) {
            return redirect('users')
                    ->with('message', 'The User: '.$user->fullname.' was deleted successful!');
        }
    }

    /**
     * Generate PDF file
     */
        
    public function pdf() {
        $users = User::all();
        $pdf = Pdf::loadView('users.pdf', compact('users'));
        return $pdf->download('allusers.pdf');
    }

    /**
     * Generate Excel file
     */
    public function excel() {
        return Excel::download(new UsersExport, 'allusers.xlsx');
    }

    /**
     * Import Excel file
     */
    public function import(Request $request) {
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        return redirect('users')->with('message', 'Users imported successfully!');
    }
}