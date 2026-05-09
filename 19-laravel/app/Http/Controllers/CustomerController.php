<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Adoption;
use App\Models\Pet;

class CustomerController extends Controller
{
    public function myprofile() {
        $user = User::find(Auth::user()->id);
        return view('customer.myprofile')->with('user', $user);
    }

    public function updateprofile(Request $request)
    {
        $validation = $request->validate([
            'document'      => ['required', 'numeric', 'unique:'.User::class.',document,'.$request->id],
            'fullname'      => ['required', 'string'],
            'gender'        => ['required'],
            'birthdate'     => ['required', 'date'],
            'phone'         => ['required', 'string'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'unique:'.User::class.',email,'.$request->id],
        ]);

        if($validation) {
                //dd($request->all());
                if($request->hasFile('photo')) {
                $photo = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('images/users'), $photo);
                // Delete old Photo
                if ($request->originphoto != 'no-photo.png' && file_exists(public_path('images/users/'.$request->originphoto))) {
                    unlink(public_path('images/users/'.$request->originphoto));
                }
            } else {
                $photo = $request->originphoto;
            }
        }
        $user = User::find(Auth::user()->id);
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if($user->save()) {
            return redirect('dashboard')
                    ->with('message', 'My profile was edited successful!');
        }
    }

    public function myadoptions() {
        $adoptions = Adoption::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('customer.myadoptions')->with('adoptions', $adoptions);
    }

    public function showmyadoption($id) {
        $adoption = Adoption::findOrFail($id);
        return view('customer.showmyadoption')->with('adopt', $adoption);
    }

    public function search(Request $request) {
        $pets = Pet::where('adopted', '!=', 1)->names($request->q)->orderBy('id','desc')->paginate(12);
        return view('customer.search')->with('pets', $pets);
    }

    public function listpets() {
        $pets = Pet::where('adopted', '!=', 1)->orderBy('id', 'desc')->paginate(12);
        return view('customer.listpets')->with('pets', $pets);
    }

    public function showpet($id) {
        $pet = Pet::findOrFail($id);
        return view('customer.showpet')->with('pet', $pet);
    }

    public function makeadoption(Request $request) {
        $counAdoptions = Adoption::where('user_id', Auth::user()->id)->count();

        if($counAdoptions < 3) {
            //save adoption
            $adoption = new Adoption();
            $adoption->user_id = Auth::user()->id;
            $adoption->pet_id = $request->pet_id;
            $adoption->save();
            //update pet status
            $pet = Pet::find($request->pet_id);
            $pet->adopted = 1;
            $pet->save();
            //Redirect with message
            return redirect('listpets')
                ->with('message', 'Adoption request submitted successfully!');
        } else {
            return redirect('dashboard')
            ->with('error', 'Its not possible, more than three adoptions per customer!');
        }
    }

}