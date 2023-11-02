<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\UpdateController;
use App\Http\Controllers\Post\DestroyController;

use App\Http\Controllers\Admin\Post\EditController as AdminEditController;
use App\Http\Controllers\Admin\Post\ShowController as AdminShowController;
use App\Http\Controllers\Admin\Post\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\Post\StoreController as AdminStoreController;
use App\Http\Controllers\Admin\Post\CreateController as AdminCreateController;
use App\Http\Controllers\Admin\Post\UpdateController as AdminUpdateController;
use App\Http\Controllers\Admin\Post\DestroyController as AdminDestroyController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('posts')->group(function () {
    Route::get('/', IndexController::class)->name('post.index');
    Route::get('/create', CreateController::class)->name('post.create');
    
    Route::post('/', StoreController::class)->name('post.store');
    Route::get('/{post}', ShowController::class)->name('post.show');
    Route::get('/{post}/edit', EditController::class)->name('post.edit');
    Route::patch('/{post}', UpdateController::class)->name('post.update');
    Route::delete('/{post}', DestroyController::class)->name('post.destroy');
});

// TICKETS
Route::prefix('tickets')->group(function () {
    Route::controller(TicketController::class)->group(function () {
        Route::get('/', 'index')->name('ticket.index');
        Route::get('/create', 'create')->name('ticket.create');
        
        Route::post('/', 'store')->name('ticket.store');
        Route::get('/{ticket}', 'show')->name('ticket.show');
        Route::get('/{ticket}/edit', 'edit')->name('ticket.edit');
        Route::patch('/{ticket}', 'update')->name('ticket.update');
        Route::delete('/{ticket}', 'destroy')->name('ticket.destroy');
    });
});
// END TICKETS


Route::prefix('admin')->group(function() {
    Route::middleware('admin')->group(function() {
        Route::prefix('post')->group(function() {
            Route::get('/', AdminIndexController::class)->name('admin.post.index');
            Route::get('/create', AdminCreateController::class)->name('admin.post.create');

            Route::post('/', AdminStoreController::class)->name('admin.post.store');
            Route::get('/{post}', AdminShowController::class)->name('admin.post.show');
            Route::get('/{post}/edit', AdminEditController::class)->name('admin.post.edit');
            Route::patch('/{post}', AdminUpdateController::class)->name('admin.post.update');
            Route::delete('/{post}', AdminDestroyController::class)->name('admin.post.destroy');
        });
    });
});


Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Auth::routes();