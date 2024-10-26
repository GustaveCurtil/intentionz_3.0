<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InvitationController;

Route::get('/', [PageController::class, 'publiek'])->name('publiek');
Route::get('/over', [PageController::class, 'over'])->name('over');
Route::get('/login', [PageController::class, 'login'])->name('login')->middleware('guest');
Route::get('/registreer', [PageController::class, 'registreer'])->name('registreer')->middleware('guest');

Route::get('/overzicht', [PageController::class, 'overzicht'])->name('overzicht')->middleware('auth');
Route::get('/instellingen', [PageController::class, 'instellingen'])->name('instellingen')->middleware('auth');
Route::get('/aanmaken', [PageController::class, 'aanmaken'])->name('aanmaken')->middleware('auth');
Route::get('/aanpassen', [PageController::class, 'aanpassen'])->name('aanpassen')->middleware('auth');
Route::get('/contactenlijst', [PageController::class, 'contactenlijst'])->name('contactenlijst')->middleware('auth');

Route::post('/create-event', [EventController::class, 'createEvent']);

Route::get('/evenement/{event}', [PageController::class, 'event']);
Route::get('/evenement/{event}/editor', [PageController::class, 'editor']);
Route::post('/evenement/{event}/opslaan', [SaveController::class, 'saveEvent']);

Route::get('/uitnodiging/{invitation_slug}', [PageController::class, 'uitnodiging']);
Route::post('/antwoorden/{event}', [InvitationController::class, 'antwoorden']);


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::post('/volg/{user}', [UserController::class, 'followUser']);
Route::post('/ontvolg/{user}', [UserController::class, 'unfollowUser']);

