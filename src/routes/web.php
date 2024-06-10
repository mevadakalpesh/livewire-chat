<?php

use App\Livewire\ChatApp\ChatApp;
use Illuminate\Support\Facades\Route;


Route::get('chat-app/{userid?}', ChatApp::class)
    ->middleware(['auth', 'web'])
    ->name('chat-app');
