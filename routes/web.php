<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Security\PermissionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MocaController;
use App\Http\Controllers\MedicController;
use App\Http\Controllers\ExportExcelController;
use App\Models\Moca;

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

Route::get('/saber-mas', function () {
    return Inertia::render('KnowMore');
})->name('knowmore');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        // Comprueba si el usuario ya completó el test
        $testCompleted = Moca::where('user_id', $user->id)->exists();

        return Inertia::render('Dashboard', [
            'auth' => [
                'user' => array_merge($user->toArray(), [
                    'test_completed' => $testCompleted
                ])
            ]
        ]);
    })->name('dashboard');

    Route::get('/prueba-audio-micro', function () {
        return Inertia::render('AudioMicTest');
    })->name('audio-mic-test');

    Route::get('/reglas', function () {
        return Inertia::render('Rules');
    })->name('rules');

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

    Route::post('/moca/uploadIdentification', [MocaController::class, 'uploadIdentification'])
        ->middleware('auth')
        ->name('Moca.uploadIdentification');

    Route::post('/moca/uploadAttention', [MocaController::class, 'uploadAttention'])
        ->middleware('auth')
        ->name('Moca.uploadAttention');

    Route::post('/moca/uploadLanguage', [MocaController::class, 'uploadLanguage'])
        ->middleware('auth')
        ->name('Moca.uploadLanguage');

    Route::post('/moca/uploadVerbalFluency', [MocaController::class, 'uploadVerbalFluency'])
        ->middleware('auth')
        ->name('Moca.uploadVerbalFluency');

    Route::post('/moca/uploadAbstraction', [MocaController::class, 'uploadAbstraction'])
        ->middleware('auth')
        ->name('Moca.uploadAbstraction');

    Route::post('/moca/uploadDelayedRecall', [MocaController::class, 'uploadDeferredRecall'])
        ->middleware('auth')
        ->name('Moca.uploadDeferredRecall');

    Route::post('/moca/uploadOrientation', [MocaController::class, 'uploadOrientation'])
        ->middleware('auth')
        ->name('Moca.uploadOrientation');

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

    Route::get('/medic/history', [MedicController::class, 'history'])
        ->middleware('auth.medic')
        ->name('Medic.History');

    Route::get('/medic/prediction/{id?}', [MedicController::class, 'prediction'])
        ->middleware('auth.medic')
        ->name('Medic.Prediction');

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

    Route::post('/medic/makeHistiryCLinic', [MedicController::class, 'makeHistiryCLinic'])
        ->middleware('auth.medic')
        ->name('Medic.makeHistiryCLinic');

    Route::post('/medic/getHistoryClinic', [MedicController::class, 'getHistoryClinic'])
        ->middleware('auth.medic')
        ->name('Medic.getHistoryClinic');

    Route::post('/medic/storePrediction', [MedicController::class, 'storePrediction'])
        ->middleware('auth.medic')
        ->name('Medic.storePrediction');

    Route::post('/proxy/predict', function (\Illuminate\Http\Request $request) {
        $response = Http::post('http://localhost:3000/predict', $request->all());
        return response()->json($response->json(), $response->status());
    });

});
