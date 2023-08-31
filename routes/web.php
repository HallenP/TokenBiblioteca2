<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// en este archivo estaran definidas las rutas
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// en esta ruta de tipo post, enviamos la ruta de la vista, luego enviamos el nombre de la funcion 
// y enviamos el nombre de la vista 

Route::post('/generate-token', 'App\Http\Controllers\GestionToken\GestionTokenController@generatetoken')->name('generate-token');

