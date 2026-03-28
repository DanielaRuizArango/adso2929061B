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

//Middleware Auth
Route::middleware('auth')->group( function () {
    // Resources
    Route::resources([
        'users'    => UserController::class,
        'pets'     => PetController::class,
        'adoption' => AdoptionController::class
    ]);
    // Export PDF
    Route::get('export/users/pdf', [UserController::class, 'pdf'])->name('users.pdf');

    //Export Excel
    Route::get('export/users/excel', [UserController::class, 'excel'])->name('users.excel');

    //Import Excel
    Route::post('import/users', [UserController::class, 'import'])->name('users.import');

    //Search
    Route::post('search/users', [UserController::class, 'search'])->name('users.search');

});

require __DIR__ . '/auth.php';
