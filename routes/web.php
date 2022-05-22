<?php

use App\Http\Controllers\EventUsers;
use App\Http\Controllers\Event;
use App\Http\Controllers\Info;
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

Auth::routes();

Route::get('/about_us', [Info::class, 'showAbout_us']);
Route::get('/contacts', [Info::class, 'showContacts']);

Route::get('/add/event', [Event::class, 'showAddEvents']);
Route::post('/add/event', [Event::class, 'addEvent']);
Route::post('/delete/event/{id}', [Event::class, 'deleteEvent']);
Route::get('/update/event/{id}', [Event::class, 'showUpdateEvent']);
Route::post('/update/event/{id}', [Event::class, 'updateEvent']);

Route::get('/', [Event::class, 'showEvents'])->name('home');
Route::get('/event/{id}', [Event::class, 'showEvent']);

Route::post('/register/event', [EventUsers::class, 'registerEvent']);
Route::get('/accept/event/{id}/{condition}', [EventUsers::class, 'accept']);
