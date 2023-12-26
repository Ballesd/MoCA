<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Security\PermissionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MocaController;
use App\Http\Controllers\MedicController;

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

    Route::post('/moca/uploadcube', [MocaController::class, 'uploadCube'])
    ->middleware('auth')
    ->name('Moca.uploadCube');
    
    Route::post('/moca/uploadclock', [MocaController::class, 'uploadClock'])
    ->middleware('auth')
    ->name('Moca.uploadclock');

    Route::post('/moca/savemis', [MocaController::class, 'saveMiss'])
    ->middleware('auth')
    ->name('Moca.savemis');

    Route::post('/moca/calification', [MocaController::class, 'editMoca'])
    ->middleware('auth')
    ->name('Moca.senData');

    //-----------------------Admin-------------------------------
    Route::get('/admin/index', [AdminController::class, 'index'])
    ->middleware('auth.admin')
    ->name('Admin.Index');

    Route::put('/admin/update', [AdminController::class, 'update'])
    ->middleware('auth.admin')
    ->name('admin.update');

    //-----------------------Medic-------------------------------
    Route::get('/medic/index', [MedicController::class, 'index'])
    ->middleware('auth.medic')
    ->name('Medic.Index');

    Route::get('/medic/show', [MedicController::class, 'show'])
    ->middleware('auth.medic')
    ->name('Medic.Show');

    Route::post('/medic/getMoca', [MedicController::class, 'getMoca'])
    ->middleware('auth.medic')
    ->name('Medic.getMoca');

    Route::put('/medic/editMoca', [MedicController::class, 'editMoca'])
    ->middleware('auth.medic')
    ->name('Medic.editMoca');

    Route::get('/medic/clinicHistory', [MedicController::class, 'clinicHistory'])
    ->middleware('auth.medic')
    ->name('Medic.clinicHistory');

    Route::post('/medic/getUser', [MedicController::class, 'getUser'])
    ->middleware('auth.medic')
    ->name('Medic.getUser');
    
});



