<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ArticleController as FrontArticle;
use App\Http\Controllers\Front\VideoController as FrontVideo;
use App\Http\Controllers\Front\FaqController as FrontFaq;
use App\Http\Controllers\Front\FacilityController as FrontFacility;
use App\Http\Controllers\Front\ThreadController as FrontThread;
use App\Http\Controllers\Front\DoctorController as FrontDoctor;
use App\Http\Controllers\Front\ProfileController as FrontProfile;
use App\Http\Controllers\PregnancyTrackerController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class,'index'])->name('home');


// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



// Front site
Route::get('/pregnancy-tracker', [PregnancyTrackerController::class,'index'])->name('pregnancy-tracker.index');

Route::get('/articles', [FrontArticle::class,'index'])->name('articles.index');
Route::get('/articles/{slug}', [FrontArticle::class,'show'])->name('articles.show');

Route::get('/videos', [FrontVideo::class,'index'])->name('videos.index');
Route::get('/videos/{video}', [FrontVideo::class,'show'])->name('videos.show');

Route::get('/facilities', [FrontFacility::class,'index'])->name('facilities.index');
Route::get('/facilities/{facility}', [FrontFacility::class,'show'])->name('facilities.show');

Route::get('/faq', [FrontFaq::class,'index'])->name('faq.index');
Route::get('/faq/{faq}', [FrontFaq::class,'show'])->name('faq.show');

Route::get('/threads', [FrontThread::class,'index'])->name('threads.index');
Route::get('/threads/create', [FrontThread::class,'create'])->name('threads.create');
Route::get('/threads/{id}', [FrontThread::class,'show'])->name('threads.show');
Route::post('/threads', [FrontThread::class,'store'])->middleware('auth')->name('threads.store');
Route::post('/threads/{thread}/comment', [FrontThread::class,'comment'])->middleware('auth')->name('threads.comment');
Route::post('/threads/{thread}/react', [FrontThread::class,'react'])->middleware('auth');

Route::get('/doctors', [FrontDoctor::class,'index'])->name('doctors.index');
Route::post('/consult', [FrontDoctor::class,'consult'])->middleware('auth');

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Dashboard (Admin only)
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');
    Route::resource('articles', ArticleController::class);
    Route::resource('videos', VideoController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('facilities', FacilityController::class);
});

