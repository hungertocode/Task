<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\WebController;
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
    return view('welcome');
});

Route::get('/login',[LoginController::class,'get'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login');

Route::middleware(['admin'])->group(function () {

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Genre Routes
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');
Route::get('/genres/edit/{genre}', [GenreController::class, 'edit'])->name('genres.edit');
Route::put('/genres/{genre}', [GenreController::class, 'update'])->name('genres.update');
Route::post('/genres/delete/{id}', [GenreController::class, 'destroy'])->name('events.delete');

Route::get('/genres/datatable-list', [GenreController::class, 'genreList'])->name('genres.list');


//artist Routes
Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artists/create', [ArtistController::class, 'create'])->name('artists.create');
Route::post('/artists', [ArtistController::class, 'store'])->name('artists.store');
Route::get('/artists/edit/{artist}', [ArtistController::class, 'edit'])->name('artists.edit');
Route::put('/artists/{artist}', [ArtistController::class, 'update'])->name('artists.update');
Route::post('/artists/delete/{id}', [ArtistController::class, 'destroy'])->name('events.delete');

Route::get('/artists/datatable-list', [ArtistController::class, 'artistList'])->name('artists.list');


//Venue Routes
Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');
Route::get('/venues/create', [VenueController::class, 'create'])->name('venues.create');
Route::post('/venues', [VenueController::class, 'store'])->name('venues.store');
Route::get('/venues/edit/{venue}', [VenueController::class, 'edit'])->name('venues.edit');
Route::put('/venues/{venue}', [VenueController::class, 'update'])->name('venues.update');
Route::post('/venues/delete/{id}', [VenueController::class, 'destroy'])->name('events.delete');

Route::get('/venues/datatable-list', [VenueController::class, 'venueList'])->name('venues.list');


//Events Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::get('/events/edit/{venue}', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{venue}', [EventController::class, 'update'])->name('events.update');
Route::post('/events/delete/{id}', [EventController::class, 'destroy'])->name('events.delete');

Route::get('/events/datatable-list', [EventController::class, 'eventList'])->name('events.list');
});


Route::get('/', [WebController::class, 'index'])->name('preview');

