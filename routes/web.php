<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/", [HomeController::class, "index"]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get("/home", [HomeController::class, "redirect"]);

Route::get("/doctor", [AdminController::class, "create"]);
Route::post("/create-doctor", [AdminController::class, "store"])->name("create-doctor");

//appointment
Route::post("/create-appointment", [HomeController::class, "createAppointment"])->name("create-appointment");
Route::get("/appointment", [HomeController::class, "appointment"])->name("appointment")->middleware("auth");
Route::get("/cancel-appointment/{id}", [HomeController::class, "cancelAppointment"])->name("cancel-appointment");
//admin list appointment
Route::get("/appointments", [AdminController::class, "appointment"])->name("appointments")->middleware("auth");
Route::get("/cancel-appointments/{id}", [AdminController::class, "cancelAppointment"])->name("cancel-appointments");
Route::get("/approved/{id}", [AdminController::class, "approved"])->name("approved");