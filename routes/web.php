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
//Route::view('/', 'welcome');
//Route::view('/', 'welcome');
//Route::view('/', 'livewire.home');
//Route::get('/',\App\Livewire\Home::class);
//Route::get('/','\App\Livewire\Home::class');
//Route::redirect('/', '/ves', 301);
Route::get('/',\App\Livewire\Index::class);

Route::get('/login',\App\Livewire\Login::class);
Route::get('/search',\App\Livewire\Search::class);
Route::get('/catalog',\App\Livewire\Catalog::class)->name('catalog');
Route::get('/rulebook',\App\Livewire\Rulebook::class)->name('rulebook');
Route::get('/ves',\App\Livewire\Ves::class)->name('ves');
Route::get('/ves-conversion',\App\Livewire\VesConversion::class)->name('ves-conversion');
Route::get('/catalog-administration',\App\Livewire\CatalogAdministration::class)->name('catalog-administration')->middleware(['auth', 'verified']);
Route::get('/rulebook-administration',\App\Livewire\RulebookAdministration::class)->name('rulebook-administration')->middleware(['auth', 'verified']);
Route::get('/regulation-administration',\App\Livewire\RegulationAdministration::class)->name('regulation-administration')->middleware(['auth', 'verified']);
Route::get('/ves-administration',\App\Livewire\VesAdministration::class)->name('ves-administration')->middleware(['auth', 'verified']);
Route::get('/user-administration',\App\Livewire\UserAdministration::class)->name('user-administration')->middleware(['role:super-admin']);

Route::get('/welcome', function(){
    $comments=Comment::all();

    return view('welcome',compact('comments'));
});

 Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
