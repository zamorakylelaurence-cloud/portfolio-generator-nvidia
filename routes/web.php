
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// Send the website's root URL to the login page.
Route::get('/', function () {
    if (auth()->check()) {
        return view('home', [
            'portfolioCount' => \App\Models\Portfolio::where(
                'user_id',
                auth()->id()
            )->count(),
        ]);
    }

    return redirect()->route('login');
})->name('home');

// Only logged-in users can access portfolio features.
Route::middleware('auth')->group(function () {
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
});

// Guests can register or log in.
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

// Only authenticated users can log out.
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
