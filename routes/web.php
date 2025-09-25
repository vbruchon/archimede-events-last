<?php

use App\Http\Controllers\AccessTypeController;
use App\Http\Controllers\Admin\AdminEventController as AdminEventController;
use App\Http\Controllers\NumberOfParticipantsController;
use App\Http\Controllers\ProfileController,
    App\Http\Controllers\EventController,
    App\Http\Controllers\StatusController,
    App\Http\Controllers\StructureController,
    App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

/* Testing e-mail with mailpit

Route::get('/send-test-email', function () {
    Mail::raw('Ceci est un test mail.', function ($message) {
        $message->to('mximenes@lemoulindigital.fr')
            ->subject('Test Email');
    });

    return 'Email de test envoyé!';
}); */


Route::redirect('/', '/login');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/dashboard')->group(function () {
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::middleware('admin')->group(function () {
            /* Route::prefix('events')->name('admin.event.')->group(function () {
                Route::get('/', [AdminEventController::class, 'index'])->name('list');
            }); */

            Route::prefix('structures')->name('admin.structure.')->group(function () {
                Route::get('/', [StructureController::class, 'index'])->name('list');
                Route::get('/create', [StructureController::class, 'create'])->name('create');
                Route::post('/store', [StructureController::class, 'store'])->name('store');
                Route::get('/{structure}/edit', [StructureController::class, 'edit'])->name('edit');
                Route::put('/{structure}/update', [StructureController::class, 'update'])->name('update');
                Route::delete('/{structure}/destroy', [StructureController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('users')->name('admin.users.')->group(function () {
                Route::get('/', [UserController::class, "index"])->name('list');
                Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
                Route::delete('/{user}/destroy', [UserController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('numberOfParticipants')->name('admin.numberOfParticipants.')->group(function () {
                Route::get('/', [NumberOfParticipantsController::class, 'index'])->name('list');
                Route::get('/create', [NumberOfParticipantsController::class, 'create'])->name('create');
                Route::post('/store', [NumberOfParticipantsController::class, 'store'])->name('store');
                Route::get('/{numberOfParticipant}/edit', [NumberOfParticipantsController::class, 'edit'])->name('edit');
                Route::put('/{numberOfParticipant}/update', [NumberOfParticipantsController::class, 'update'])->name('update');
                Route::delete('/{numberOfParticipant}/destroy', [NumberOfParticipantsController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('accessType')->name('admin.accessType.')->group(function () {
                Route::get('/', [AccessTypeController::class, 'index'])->name('list');
                Route::get('/create', [AccessTypeController::class, 'create'])->name('create');
                Route::post('/store', [AccessTypeController::class, 'store'])->name('store');
                Route::get('/{accessType}/edit', [AccessTypeController::class, 'edit'])->name('edit');
                Route::put('/{accessType}/update', [AccessTypeController::class, 'update'])->name('update');
                Route::delete('/{accessType}/destroy', [AccessTypeController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('tags')->name('admin.tags.')->group(function () {
                Route::get('/', [TagController::class, 'index'])->name('list');
                Route::get('/create', [TagController::class, 'create'])->name('create');
                Route::post('/store', [TagController::class, 'store'])->name('store');
                Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('edit');
                Route::put('/{tag}/update', [TagController::class, 'update'])->name('update');
                Route::delete('/{tag}/destroy', [TagController::class, 'destroy'])->name('destroy');
            });
        });

        Route::prefix('events')->name('userEvent.')->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('all');
            Route::get('/filtered', [EventController::class, 'filteredEvents'])->name('filter');
            Route::get('/create', [EventController::class, 'create'])->name('create');
            Route::get('/my', [EventController::class, 'userContribution'])->name('my');
            Route::post('/add', [EventController::class, 'store'])->name('add');
            Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
            Route::put('/{event}/update', [EventController::class, 'update'])->name('update');
            Route::delete('/{event}/destroy', [EventController::class, 'destroy'])->name('destroy');
            Route::get('/calendar', function () {
                return view('event.calendar');
            })->name('calendar');
        });
    });
});

require __DIR__ . '/auth.php';
