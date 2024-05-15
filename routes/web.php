<?php

use App\Http\Controllers\ArtistController;
use App\Livewire\Artist;
use Illuminate\Support\Facades\Route;

Route::get('/', Artist::class);
Route::get('/', [ArtistController::class, 'index']);
