<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "<main style='min-height: 100dvh; display: flex; align-items: center; justify-content: center;'>
    <h1 style='font-family: Arial; font-size: 2rem'>
    ✅ Check API EndPoints in Postman/ApiDog
    </h1>
    </main>";
});
