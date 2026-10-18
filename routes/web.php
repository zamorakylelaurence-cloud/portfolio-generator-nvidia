<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'home'])
    ->name('home');

Route::resource('portfolios', PortfolioController::class)
    ->except(['show']);

Route::get('/portfolios/{portfolio}/templates', [PortfolioController::class, 'templates'])
    ->name('portfolios.templates');

Route::get('/portfolios/{portfolio}/preview', [PortfolioController::class, 'preview'])
    ->name('portfolios.preview');

Route::post('/portfolios/{portfolio}/template', [PortfolioController::class, 'updateTemplate'])
    ->name('portfolios.template');

Route::get('/portfolios/{portfolio}/download', [PortfolioController::class, 'downloadHtml'])
    ->name('portfolios.download');
