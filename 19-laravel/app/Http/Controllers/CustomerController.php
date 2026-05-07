<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Adoption;

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

    public function showmyadoption(Request $request) {
        $adoption = Adoption::find($request->id);
        return view('customer.showmyadoption')->with('adopt', $adoption);
    }
}