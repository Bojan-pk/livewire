<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

//Route::view('/', 'welcome');
/* Route::view('/', 'livewire.home'); */

Route::get('/',\App\Livewire\Home::class);

/* Route::get('/', function(){
    $comments=Comment::all();


   // dd($comments);
    return view('welcome',compact('comments'));
});
 */
/* Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
 */
require __DIR__.'/auth.php';
