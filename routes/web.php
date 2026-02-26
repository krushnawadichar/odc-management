<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::post('/approve/{id}',[AdminController::class,'approve']);
});


// admin routes

    Route::get('/cmpany-list',[CompanyController::class,'companyList'])->name('company.list');
    Route::get('/employe-list',[EmployeController::class,'employeList'])->name('employe.list');
    Route::get('/employe-add',[EmployeController::class,'adminAddEmployeView'])->name('admin.add.employe');
    Route::get('/employe-store',[EmployeController::class,'adminStoreEmploye'])->name('admin.employes.store');

require __DIR__.'/auth.php';
