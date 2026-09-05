<?php

use App\Http\Controllers\Admin\QuizAttemptController;
use App\Http\Controllers\Admin\QuizLevelController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\QuizTechnologyController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Skill Eligibility Test (public)
Route::get('/skill-test', [QuizController::class, 'index'])->name('skill-test.index');
Route::post('/skill-test/start', [QuizController::class, 'start'])->middleware('throttle:skill-test-start')->name('skill-test.start');
Route::get('/skill-test/{attempt}/exam', [QuizController::class, 'exam'])->name('skill-test.exam');
Route::get('/skill-test/{attempt}/result', [QuizController::class, 'result'])->name('skill-test.result');

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

// Skill Test admin
Route::middleware(['auth', 'verified'])->prefix('admin/skill-test')->name('admin.skill-test.')->group(function () {
    Route::get('attempts', [QuizAttemptController::class, 'index'])->name('attempts.index');
    Route::get('attempts/{attempt}', [QuizAttemptController::class, 'show'])->name('attempts.show');

    Route::get('questions', [QuizQuestionController::class, 'index'])->name('questions.index');
    Route::get('questions/create', [QuizQuestionController::class, 'create'])->name('questions.create');
    Route::get('questions/{question}/edit', [QuizQuestionController::class, 'edit'])->name('questions.edit');
    Route::delete('questions/{question}', [QuizQuestionController::class, 'destroy'])->name('questions.destroy');

    Route::get('technologies', [QuizTechnologyController::class, 'index'])->name('technologies.index');
    Route::post('technologies', [QuizTechnologyController::class, 'store'])->name('technologies.store');
    Route::patch('technologies/{technology}', [QuizTechnologyController::class, 'update'])->name('technologies.update');
    Route::delete('technologies/{technology}', [QuizTechnologyController::class, 'destroy'])->name('technologies.destroy');

    Route::get('levels', [QuizLevelController::class, 'index'])->name('levels.index');
    Route::patch('levels/{level}', [QuizLevelController::class, 'update'])->name('levels.update');
});

require __DIR__.'/auth.php';
