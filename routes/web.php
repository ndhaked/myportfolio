<?php

use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// SEO Pages
Route::get('/laravel-expert-in-jaipur', [SeoController::class, 'laravelExpertJaipur'])->name('seo.laravel-expert-jaipur');
Route::get('/hire-laravel-developer-in-jaipur', [SeoController::class, 'hireLaravelDeveloperJaipur'])->name('seo.hire-laravel-developer-jaipur');
Route::get('/senior-laravel-developer-india', [SeoController::class, 'seniorLaravelDeveloperIndia'])->name('seo.senior-laravel-developer-india');
Route::get('/laravel-api-development', [SeoController::class, 'laravelApiDevelopment'])->name('seo.laravel-api-development');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

Route::redirect('dashboard', '/admin/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('admin/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::redirect('profile', '/admin/profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('admin/profile', 'profile')
    ->middleware(['auth'])
    ->name('admin.profile');

Route::view('admin/portfolio', 'admin.portfolio')
    ->middleware(['auth', 'verified'])
    ->name('admin.portfolio');

Route::view('admin/reviews', 'admin.reviews')
    ->middleware(['auth', 'verified'])
    ->name('admin.reviews');

require __DIR__.'/auth.php';
