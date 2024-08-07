<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HolidayModeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveTypeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home',[HomeController::class,'index']);

Route::get('/main', function () {
    return view('admin.layout.main');
});


//DepartmentView
Route::get('/admincreatedepartment',[DepartmentController::class, 'index'])->name('department.create');
Route::post('/admincreatedepartment',[DepartmentController::class, 'create'])->name('department.store');
Route::get('/departmentlist',[DepartmentController::class, 'departmentlist'])->name('department.list');
Route::delete('/deletedepartment/{id}',[DepartmentController::class, 'delete'])->name('department.delete');
Route::get('/editdepartment/{id}',[DepartmentController::class, 'edit'])->name('department.edit');
Route::post('/updatedepartment',[DepartmentController::class, 'update'])->name('department.update');

//UserView
Route::get('/admincreateuser',[UserController::class, 'index'])->name('user.create');
Route::post('/adminstoreuser',[UserController::class, 'create'])->name('user.store');
Route::get('/userlist',[UserController::class, 'userlist'])->name('user.list');
Route::delete('/deleteuser/{id}',[UserController::class, 'delete'])->name('user.delete');
Route::get('/edituser/{id}',[UserController::class, 'edit'])->name('user.edit');
Route::post('/updateuser',[UserController::class, 'update'])->name('user.update');
Route::get('/listadminleave',[LeaveController::class, 'list_dashboard'])->name('leave.listdashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//LeaveView
Route::get('/applyleave/',[LeaveController::class, 'index'])->name('leave.create');
Route::get('/ajax-handler/{id}', [LeaveController::class, 'ajaxHandler'])->name('ajax.handler');
Route::post('/createleave',[LeaveController::class, 'apply'])->name('leave.store');
Route::post('/createleaveasadmin',[LeaveController::class, 'applyasadmin'])->name('leave.admin.store');
Route::get('/listleave',[LeaveController::class, 'list'])->name('leave.list');
Route::post('/approveleave/{id}',[LeaveController::class, 'approve'])->name('leave.approve');
Route::post('/rejectleave',[LeaveController::class, 'reject'])->name('leave.reject');
Route::delete('/deleteleave/{id}',[LeaveController::class, 'delete'])->name('leave.delete');

//Leave Type View
Route::get('/createleavetype',[LeaveTypeController::class,'index'])->name('leavetype.create');
Route::post('/storeleavetype',[LeaveTypeController::class,'create'])->name('leavetype.store');
Route::get('/leavetypelist',[LeaveTypeController::class,'list'])->name('leavetype.list');
Route::delete('/deleteleavetype/{id}',[LeaveTypeController::class, 'delete'])->name('leavetype.delete');

//CalendarView
Route::get('/calendar',[CalendarController::class,'index'])->name('calendar');

//Holiday view
Route::get('/holiday',[HolidayController::class,'index'])->name('create.holiday');
Route::post('/createholiday',[HolidayController::class,'create'])->name('store.holiday');
Route::get('/listholiday',[HolidayController::class,'list'])->name('list.holiday');
Route::get('/editholiday/{id}',[HolidayController::class,'edit'])->name('edit.holiday');
Route::post('/updateholiday',[HolidayController::class,'update'])->name('update.holiday');
Route::delete('/deleteholiday/{id}',[HolidayController::class,'delete'])->name('delete.holiday');

//HolidayMode View
Route::get('/holidaymode',[HolidayModeController::class,'index'])->name('create.mode');
Route::post('/createholidaymode',[HolidayModeController::class,'create'])->name('store.mode');
Route::get('/selectholidaymode',[HolidayModeController::class,'select'])->name('select.mode');
Route::post('/getholidayid',[HolidayModeController::class,'selector'])->name('selector.mode');

require __DIR__.'/auth.php';
