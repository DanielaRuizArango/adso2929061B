<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pet;
use App\Models\Adoption;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/hello', function () {
    return "<h1>Hello Laravel👾</h1>";
});

Route::get('sayhello/{name}', function () {
    return "<h1>Hello" . request()->name . "</h1>";
});

Route::get('getall/pets', function () {
    $pet = App\Models\Pet::all();
    dd($pet->toArray());
});

Route::get('getall/pets/{id}', function () {
    $pet = App\Models\Pet::find(request()->id);
    dd($pet->toArray());
});

Route::get('challenge', function () {

    $users = User::take(20)->get();

    $style = "
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #0d6efd;
            color: white;
        }
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    ";

    $table = "<table>";
    $table .= "<tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Fullname</th>
                <th>Age</th>
                <th>Created (Years)</th>
                </tr>";

    foreach ($users as $user) {

        $age = Carbon::parse($user->birthdate)->diffForHumans();
        $created = Carbon::parse($user->created_at)->diffForHumans();

        $photo = "<img src='" . asset($user->photo) . "' width='50'>";


        $table .= "<tr>
                    <td>{$user->id}</td>
                    <td>{$photo}</td>
                    <td>{$user->fullname}</td>
                    <td>{$age}</td>
                    <td>{$created}</td>
                    </tr>";
    }

    $table .= "</table>";

    return $style . $table;
});

Route::get('getall/pets', function () {
    $pets = App\Models\Pet::all();
    return view('getallpets')->with('pets', $pets);
});

Route::get('showpet/{id}', function () {
    $pet = App\Models\Pet::find(request()->id);
    return view('showpet')->with('pet', $pet);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Middleware Auth
Route::middleware('auth')->group( function () {
    // Resources with Admin Access
    Route::middleware('admin')->group( function () {
        Route::resources([
            'users'     => UserController::class,
            'pets'      => PetController::class,
        ]);
        Route::resource('adoptions', AdoptionController::class)->except(['edit', 'update', 'destroy']);
    });
    // Exports PDF
    Route::get('export/users/pdf', [UserController::class, 'pdf']);

    // Exports Excel
    Route::get('export/users/excel', [UserController::class, 'excel']);

    // Import Excel
    Route::post('import/users', [UserController::class, 'import']);

    // Search Users
    Route::post('search/users', [UserController::class, 'search']);

    // Exports PDF Pets
    Route::get('export/pets/pdf', [PetController::class, 'pdf']);

    // Exports Excel Pets
    Route::get('export/pets/excel', [PetController::class, 'excel']);

    // Search Pets
    Route::post('search/pets', [PetController::class, 'search']);

    // Exports PDF Adoptions
    Route::get('export/adoptions/pdf', [AdoptionController::class, 'pdf']);

    // Exports Excel Adoptions
    Route::get('export/adoptions/excel', [AdoptionController::class, 'excel']);

    // Search Adoptions
    Route::post('search/adoptions', [AdoptionController::class, 'search']);
});

// Search

Route::post('search/users', [UserController::class, 'search']);
Route::post('search/pets', [PetController::class, 'search']);
Route::post('search/adoptions', [AdoptionController::class, 'search']);

// Customer
Route::get('myprofile/', [CustomerController::class, 'myprofile']);
Route::put('myprofile/{id}', [CustomerController::class, 'updateprofile']);

Route::get('myadoptions/', [CustomerController::class, 'myadoptions']);
Route::get('myadoption/{id}', [CustomerController::class, 'showmyadoption']);

Route::get('makeadoption/', [CustomerController::class, 'listpets']);
Route::post('search/adoptionpets', [CustomerController::class, 'search']);
Route::get('confirmadoption/{id}', [CustomerController::class, 'showpet']);
Route::post('makeadoption/{id}', [CustomerController::class, 'makeadoption']);


require __DIR__.'/auth.php';
