<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WorkerController;



// admin routes

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Company routes


// Company routes
Route::get('/company-list', [CompanyController::class, 'companyList'])->name('company.list');
Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
Route::get('/company/show/{id}', [CompanyController::class, 'show'])->name('company.show');
Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
Route::put('/company/update/{id}', [CompanyController::class, 'update'])->name('company.update');
Route::delete('/company/delete/{id}', [CompanyController::class, 'destroy'])->name('company.delete');
Route::post('/company/bulk-delete', [CompanyController::class, 'bulkDelete'])->name('company.bulk-delete');

Route::post('/company/verify/{id}', [CompanyController::class, 'verify'])->name('company.verify');
Route::post('/company/bulk-delete', [CompanyController::class, 'bulkDelete'])->name('company.bulk-delete');
Route::post('/company/bulk-verify', [CompanyController::class, 'bulkVerify'])->name('company.bulk-verify');





// AJAX routes for location
Route::get('/get-states/{countryId}', [CompanyController::class, 'getStates'])->name('get.states');
Route::get('/get-cities/{stateId}', [CompanyController::class,'getCities'])->name('get.cities');


    Route::get('/employe-store',[WorkerController::class,'adminStoreEmploye'])->name('admin.employes.store');

        // Worker Routes
    Route::get('/worker/list', [WorkerController::class, 'workerList'])->name('worker.list');
    Route::get('/worker/add', [WorkerController::class, 'form'])->name('admin.add.worker');
    Route::get('/worker/edit/{id}', [WorkerController::class, 'form'])->name('admin.edit.worker');
    Route::post('/worker/store', [WorkerController::class, 'store'])->name('workers.store');
    Route::put('/worker/update/{id}', [WorkerController::class, 'update'])->name('workers.update');
    Route::get('/worker/show/{id}', [WorkerController::class, 'show'])->name('workers.show');
    Route::delete('/worker/destroy/{id}', [WorkerController::class, 'destroy'])->name('workers.destroy');




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class,'home'])->name('home');
/* Manpower */
Route::get('/manpower/register', [FrontendController::class,'showManpowerForm'])->name('manpower.form');
Route::post('/manpower/register', [FrontendController::class,'registerManpower'])->name('manpower.store');

/* Company */
Route::get('/company/register', [FrontendController::class,'showCompanyForm'])->name('company.form');
Route::post('/company/register', [FrontendController::class,'registerCompany'])->name('company.store');

// New Pages
Route::get('/workers', [FrontendController::class, 'workers'])->name('workers');
Route::get('/companies', [FrontendController::class, 'companies'])->name('companies');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');






//===========================================================================


// Route::get('/', [FrontendController::class,'home'])->name('home');
// /* Manpower */
// Route::get('/manpower/register', [FrontendController::class,'showManpowerForm'])->name('manpower.form');
// Route::post('/manpower/register', [FrontendController::class,'registerManpower'])->name('manpower.store');

// /* Company */
// Route::get('/company/register', [FrontendController::class,'showCompanyForm'])->name('company.form');
// Route::post('/company/register', [FrontendController::class,'registerCompany'])->name('company.store');



Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::post('/approve/{id}',[AdminController::class,'approve']);
});


require __DIR__.'/auth.php';
