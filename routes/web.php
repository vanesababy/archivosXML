<?php

use App\Http\Controllers\xmlController;
use App\Models\persona;
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

Route::get('/', function () {
    return view('index');
});
Route::post('/xml/upload', [xmlController::class, 'upload'])->name('xml.upload');
Route::get('index', [xmlController::class, 'index'])->name('index');
Route::get('/xml/download', [xmlController::class, 'download'])->name('xml.download');

