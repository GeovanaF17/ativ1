<?php
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [NoteController::class,'dasboard'])->middleware(['auth'])->name('dashboard');
Route::post('criar_anotacao',[NoteController::class, 'create'])->middleware(['auth'])->name('create.note');

require __DIR__.'/auth.php';
