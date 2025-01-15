<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cms\RoleController;
use App\Http\Controllers\cms\UserController;
use App\Http\Controllers\cms\CrateController;
use App\Http\Controllers\cms\ModuleController;
use App\Http\Controllers\cms\CompanyController;
use App\Http\Controllers\cms\DashboardController;
use App\Http\Controllers\cms\PermissionController;
use App\Http\Controllers\cms\ActivityLogsController;
use App\Http\Controllers\cms\CrateTransferController;

Route::get('/dashboard',                    [DashboardController::class,'dashboard'])->name('dashboard');

//user management
Route::resource('user',                     UserController::class);
Route::resource('role',                     RoleController::class);
Route::resource('permission',               PermissionController::class);
Route::resource('module',                   ModuleController::class);
Route::get("assign/user/roles/{id}",        [UserController::class,'assignRoleForm'])->name('assignRoles');
Route::post("submit/user/roles",            [UserController::class,'assignRole'])->name('submitRole');
Route::get("assign/role/permissions/{id}",  [RoleController::class,'assignPermissionForm'])->name('assignPermissions');
Route::post("submit/role/permissions",      [RoleController::class,'assignPermission'])->name('submitPermission');
Route::get("/change/password",              [UserController::class,'changePassword'])->name("changePassword");
Route::post("/update/password",             [UserController::class,'updatePassword'])->name("updatePassword");
Route::get("switch/user/form",              [UserController::class,'switchUserForm'])->name('switchUserForm');
Route::post("switch/user",                  [UserController::class,'switchUser'])->name('switchUser');
Route::get("logout/switch/user",            [UserController::class,'logoutSwitchUser'])->name('logoutSwitchUser');
Route::get('profile/{id}',                  [UserController::class,'profile'])->name('userProfile');
Route::put('store-profile,{id}',            [UserController::class,'storeProfile'])->name('storeProfile');

//Company
Route::resource('company',                  CompanyController::class);

//Crate
Route::resource('crate',                    CrateController::class);

//Crate Transfer
Route::get('transfer-form',                 [CrateTransferController::class,'crateTransferForm'])->name('crateTransferForm');
Route::post('crate-transfer-store',         [CrateTransferController::class,'crateTransferStore'])->name('crateTransferStore');
// Route::get('list-companies-with-crates',    [CrateTransferController::class,'listCompaniesWithCrates'])->name('listCompaniesWithCrates');

//Activity logs
Route::get("activity/logs",                 [ActivityLogsController::class,'index'])->name("activityLogs");
