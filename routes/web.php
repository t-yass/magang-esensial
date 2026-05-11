<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PublicBlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\VideoContentController;
use App\Http\Controllers\Admin\WorkshopIntensifController;
use Illuminate\Support\Facades\Route;

// ── Public ────────────────────────────────────────────────
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/blog', [PublicBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PublicBlogController::class, 'show'])->name('blog.show');

// ── Admin Auth ────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // ── Protected Admin Routes ────────────────────────────
    Route::middleware('admin')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Settings
        Route::get('/hero',             [SettingController::class, 'hero'])->name('hero');
        Route::post('/hero',            [SettingController::class, 'updateHero'])->name('hero.update');

        Route::get('/about',            [SettingController::class, 'about'])->name('about');
        Route::post('/about',           [SettingController::class, 'updateAbout'])->name('about.update');

        Route::get('/contact',          [SettingController::class, 'contact'])->name('contact');
        Route::post('/contact',         [SettingController::class, 'updateContact'])->name('contact.update');

        Route::get('/appearance',       [SettingController::class, 'appearance'])->name('appearance');
        Route::post('/appearance',      [SettingController::class, 'updateAppearance'])->name('appearance.update');

        // Programs
        Route::get('/programs',         [ProgramController::class, 'index'])->name('programs');
        Route::post('/programs',        [ProgramController::class, 'store'])->name('programs.store');
        Route::put('/programs/{program}',    [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');

        // Partners
        Route::get('/partners',         [PartnerController::class, 'index'])->name('partners');
        Route::post('/partners',        [PartnerController::class, 'store'])->name('partners.store');
        Route::put('/partners/{partner}',    [PartnerController::class, 'update'])->name('partners.update');
        Route::patch('/partners/{partner}/toggle', [PartnerController::class, 'toggleVisible'])->name('partners.toggle');
        Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');

        // Blog
        Route::get('/blog',             [BlogController::class, 'index'])->name('blog');
        Route::post('/blog',            [BlogController::class, 'store'])->name('blog.store');
        Route::put('/blog/{post}',      [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{post}',   [BlogController::class, 'destroy'])->name('blog.destroy');

        // Gallery
        Route::get('/gallery',          [GalleryController::class, 'index'])->name('gallery');
        Route::post('/gallery',         [GalleryController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

        // Workshop Intensif
        Route::get('/workshop-intensif',  [WorkshopIntensifController::class, 'index'])->name('workshop-intensif');
        Route::put('/workshop-intensif/{workshop}', [WorkshopIntensifController::class, 'update'])->name('workshop-intensif.update');
        Route::post('/workshop-intensif/{workshop}/photo', [WorkshopIntensifController::class, 'uploadPhoto'])->name('workshop-intensif.photo.upload');
        Route::delete('/workshop-intensif/photo/{photo}', [WorkshopIntensifController::class, 'deletePhoto'])->name('workshop-intensif.photo.delete');
        Route::patch('/workshop-intensif/photo/{photo}/toggle', [WorkshopIntensifController::class, 'togglePhotoVisibility'])->name('workshop-intensif.photo.toggle');

        // Video Content
        Route::get('/video-content', [VideoContentController::class, 'index'])->name('video-content');
        Route::post('/video-content', [VideoContentController::class, 'store'])->name('video-content.store');
        Route::put('/video-content/{video}', [VideoContentController::class, 'update'])->name('video-content.update');
        Route::delete('/video-content/{video}', [VideoContentController::class, 'destroy'])->name('video-content.destroy');
    });
});