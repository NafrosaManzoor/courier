<?php 

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\index;
use App\Http\Controllers\NewBranchController;
use App\Http\Controllers\NewParcelController;
use App\Http\Controllers\NewStaffController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\pages;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('index');
});

// Page routes
Route::get('/index', [pages::class, 'index']);
Route::get('/service', [pages::class, 'service']);
Route::get('/about', [pages::class, 'about']);
Route::get('/contact', [pages::class, 'contact']);
Route::get('/track_quote', [pages::class, 'track_quote']);
Route::get('/track', [pages::class, 'track']);
Route::get('/express', [pages::class, 'express']);
Route::get('/standard', [pages::class, 'standard']);
Route::get('/pallet', [pages::class, 'pallet']);
Route::get('/international', [pages::class, 'international']);
Route::get('/weight_price', [pages::class, 'weight_price']);
Route::get('/user_login', [pages::class, 'user_login']);

// Admin dashboard views
Route::view('/admin.dashboard', 'admin.dashboard');
Route::view('/admin.side_bar', 'admin.side_bar');
Route::view('/admin.layout', 'admin.layout');
//Route::view('/admin.new_branch', 'admin.new_branch');
// Route::view('/admin.list_branch', 'admin.list_branch');
// Route::view('/admin.new_parcel', 'admin.new_parcel');
// Route::view('/admin.list_parcel', 'admin.list_parcel'); // Adjusted to point to the correct view
// Route::view('/admin.new_staff', 'admin.new_staff');
// Route::view('/admin.list_staff', 'admin.list_staff'); // Adjusted to point to the correct view
Route::view('/admin.tracking', 'admin.tracking');
//Route::view('/admin.report', 'admin.report');


// Branches CRUD
Route::get('/admin.new_branch', [NewBranchController::class, 'create'])->name('branches.create');
Route::post('/branches', [NewBranchController::class, 'saveBranch'])->name('branches.store');
Route::get('/admin.list_branch', [NewBranchController::class, 'index'])->name('branches.index');
Route::get('/admin.list_branch/{id}/edit', [NewBranchController::class, 'editBranch'])->name('branches.edit');
Route::put('/admin.list_branch/{id}', [NewBranchController::class, 'saveBranch'])->name('branches.update');
Route::delete('/admin.list_branch/{id}', [NewBranchController::class, 'destroy'])->name('branches.destroy');


// Parcels CRUD
Route::resource('parcels', NewParcelController::class);
Route::get('/admin.new_parcel', [NewParcelController::class, 'create'])->name('parcels.create'); // Route for creating a new parcel
Route::post('/parcels', [NewParcelController::class, 'store'])->name('parcels.store'); // Route to store parcel in database
Route::get('/admin.list_parcel', [NewParcelController::class, 'index'])->name('parcels.index'); // Route for listing all parcels
Route::get('/admin.list_parcel/{id}/edit', [NewParcelController::class, 'edit'])->name('parcels.edit'); // Route for editing a parcel
Route::put('/admin.list_parcel/{id}', [NewParcelController::class, 'update'])->name('parcels.update'); // Route to update a parcel
Route::delete('/admin.list_parcel/{id}', [NewParcelController::class, 'destroy'])->name('parcels.destroy'); // Route to delete a parcel
Route::post('/sendTrackingEmail', [NewParcelController::class, 'sendTrackingEmail'])->name('sendTrackingEmail');
// Route::put('/parcels/{id}', 'ParcelController@update')->name('parcels.update');
Route::put('/admin/list_parcel/{id}', [NewParcelController::class, 'update'])->name('parcels.update');



// Staff CRUD
Route::get('/admin.new_staff', [NewStaffController::class, 'create'])->name('staff.create');
Route::post('/staffs', [NewStaffController::class, 'saveStaff'])->name('staff.save');
Route::get('/admin.list_staff', [NewStaffController::class, 'index'])->name('staff.index'); // Changed from list to index
Route::get('/admin.list_staff/{id}/edit', [NewStaffController::class, 'edit'])->name('staff.edit'); // Added edit route
Route::put('/admin.list_staff/{id}', [NewStaffController::class, 'saveStaff'])->name('staff.update'); // Added update route
Route::delete('/admin.list_staff/{id}', [NewStaffController::class, 'destroy'])->name('staff.destroy'); // Added destroy route



Route::get('/admin.report', [ReportController::class, 'index'])->name('report.index');
Route::post('/admin.report', [ReportController::class, 'generateReport'])->name('generate.report');
Route::post('/sendTrackingEmail', [NewParcelController::class, 'sendTrackingEmail'])->name('sendTrackingEmail');