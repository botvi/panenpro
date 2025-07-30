<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{
    DashboardController,
    LoginController,
};
use App\Http\Controllers\mandor\{
    DashboardMandorController,
    PemanenController,
    AKPController,
    GrafikKepatuhanController,
    AbsensiPemanenController,
    AbsensiBerkalaController,
};
use App\Http\Controllers\asisten\{
    DashboardAsistenController,
    MandorController,
    AKPController as AsistenAKPController,
    GrafikKepatuhanController as AsistenGrafikKepatuhanController,
    AbsensiPemanenController as AsistenAbsensiPemanenController,
    AbsensiBerkalaController as AsistenAbsensiBerkalaController,
    DataBlokController,
    DataPanenController as AsistenDataPanenController,
};
use App\Http\Controllers\pemanen\{
    DashboardPemanenController,
    DataPanenController,
};

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

Route::get('/run-asisten', function () {
    Artisan::call('db:seed', [
        '--class' => 'AsistenSeeder'
    ]);

    return "AsistenSeeder has been create successfully!";
});
Route::get('/', [LoginController::class, 'showLoginForm'])->name('formlogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::group(['middleware' => ['role:asisten']], function () {
    Route::get('/dashboard-asisten', [DashboardAsistenController::class, 'index'])->name('dashboard-asisten');
    Route::resource('datamandor', MandorController::class);
    Route::get('/asisten/akp', [AsistenAKPController::class, 'indexAKP'])->name('asisten.akp.index');
    Route::get('/asisten/grafikkepatuhan', [AsistenGrafikKepatuhanController::class, 'index'])->name('asisten.grafikkepatuhan.index');
    Route::get('/asisten/absensipemanen', [AsistenAbsensiPemanenController::class, 'index'])->name('asisten.absensipemanen.index');
    Route::get('/asisten/absensiberkala', [AsistenAbsensiBerkalaController::class, 'index'])->name('asisten.absensiberkala.index');
    Route::get('/asisten/datapanen', [AsistenDataPanenController::class, 'index'])->name('asisten.datapanen.index');
    Route::resource('datablok', DataBlokController::class);
});

Route::group(['middleware' => ['role:mandor']], function () {
    Route::get('/dashboard-mandor', [DashboardMandorController::class, 'index'])->name('dashboard-mandor');
    Route::resource('datapemanen', PemanenController::class);


    // AKP
    Route::get('/akp', [AKPController::class, 'indexAKP'])->name('akp.index');

    Route::get('/planakp/create', [AKPController::class, 'createPlanAKP'])->name('planakp.create');
    Route::post('/planakp/store', [AKPController::class, 'storePlanAKP'])->name('planakp.store');
    Route::get('/planakp/edit/{id}', [AKPController::class, 'editPlanAKP'])->name('planakp.edit');
    Route::put('/planakp/update/{id}', [AKPController::class, 'updatePlanAKP'])->name('planakp.update');
    Route::delete('/planakp/destroy/{id}', [AKPController::class, 'destroyPlanAKP'])->name('planakp.destroy');

    Route::get('/aktualakp/create', [AKPController::class, 'createAktualAKP'])->name('aktualakp.create');
    Route::post('/aktualakp/store', [AKPController::class, 'storeAktualAKP'])->name('aktualakp.store');
    Route::get('/aktualakp/edit/{id}', [AKPController::class, 'editAktualAKP'])->name('aktualakp.edit');
    Route::put('/aktualakp/update/{id}', [AKPController::class, 'updateAktualAKP'])->name('aktualakp.update');
    Route::delete('/aktualakp/destroy/{id}', [AKPController::class, 'destroyAktualAKP'])->name('aktualakp.destroy');
    // AKP

    Route::resource('grafikkepatuhan', GrafikKepatuhanController::class);
    Route::resource('absensipemanen', AbsensiPemanenController::class);
    Route::resource('absensiberkala', AbsensiBerkalaController::class);
});

Route::group(['middleware' => ['role:pemanen']], function () {
    Route::get('/dashboard-pemanen', [DashboardPemanenController::class, 'index'])->name('dashboard-pemanen');
    Route::resource('datapanen', DataPanenController::class);
});
