<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\DepartmentController;
use App\Models\College;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('colleges', CollegeController::class);
Route::resource('departments', DepartmentController::class);
