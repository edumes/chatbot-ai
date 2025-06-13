<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Chatbot - usando apenas Livewire
    Route::get('/chatbot/{chatId?}', function ($chatId = null) {
        return view('pages.chatbot', ['chatId' => $chatId]);
    })->name('chatbot');

    Route::fallback(function () {
        return view('pages/utility/404');
    });
});
