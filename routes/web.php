<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Security\PermissionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MocaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //---------------------MOCA--------------------------------
    Route::get('/moca', function () {
        return Inertia::render('Moca/Index');
    })->name('Moca.Index');

    Route::post('/moca/uploadConceptualAlternative', [MocaController::class, 'uploadConceptualAlternative'])
    ->middleware('auth')
    ->name('Moca.UploadConceptualAlternative');

    //-----------------------Admin-------------------------------
    Route::get('/admin/index', [AdminController::class, 'index'])
    ->middleware('auth.admin')
    ->name('Admin.Index');

    Route::put('/admin/update', [AdminController::class, 'update'])
    ->middleware('auth.admin')
    ->name('admin.update');

});



