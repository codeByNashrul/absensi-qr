<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {

        $totalStudents = \App\Models\Student::count();

        $totalActivities = \App\Models\Activity::count();

        $activeSessions = \App\Models\AttendanceSession::where('is_active', true)->count();

        $todayAttendances = \App\Models\Attendance::whereDate('scan_time', today())->count();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalActivities',
            'activeSessions',
            'todayAttendances'
        ));
    });
    Route::get('/admin/classes', [\App\Http\Controllers\Admin\SchoolClassController::class, 'index']);
    Route::get('/admin/classes/create', [\App\Http\Controllers\Admin\SchoolClassController::class, 'create']);
    Route::post('/admin/classes', [\App\Http\Controllers\Admin\SchoolClassController::class, 'store']);
    Route::get('/admin/activity-categories', [\App\Http\Controllers\Admin\ActivityCategoryController::class, 'index']);
    Route::get('/admin/activity-categories/create', [\App\Http\Controllers\Admin\ActivityCategoryController::class, 'create']);
    Route::post('/admin/activity-categories', [\App\Http\Controllers\Admin\ActivityCategoryController::class, 'store']);
    Route::get('/admin/activities', [\App\Http\Controllers\Admin\ActivityController::class, 'index']);
    Route::get('/admin/activities/create', [\App\Http\Controllers\Admin\ActivityController::class, 'create']);
    Route::post('/admin/activities', [\App\Http\Controllers\Admin\ActivityController::class, 'store']);
    Route::get('/admin/students', [\App\Http\Controllers\Admin\StudentController::class, 'index']);
    Route::get('/admin/students/create', [\App\Http\Controllers\Admin\StudentController::class, 'create']);
    Route::post('/admin/students', [\App\Http\Controllers\Admin\StudentController::class, 'store']);
    Route::get('/admin/sessions', [\App\Http\Controllers\Admin\AttendanceSessionController::class, 'index']);
    Route::get('/admin/sessions/create', [\App\Http\Controllers\Admin\AttendanceSessionController::class, 'create']);
    Route::post('/admin/sessions', [\App\Http\Controllers\Admin\AttendanceSessionController::class, 'store']);
    Route::get('/admin/sessions/{id}/scanner', [\App\Http\Controllers\Admin\AttendanceSessionController::class, 'scanner']);
    Route::post('/admin/sessions/{id}/scan', [\App\Http\Controllers\Admin\AttendanceSessionController::class, 'scan']);
    Route::get('/admin/attendances', [\App\Http\Controllers\Admin\AttendanceController::class, 'index']);
    Route::get('/admin/attendances/export', [\App\Http\Controllers\Admin\AttendanceController::class, 'export']);
    Route::get('/admin/sessions/{id}', [\App\Http\Controllers\Admin\AttendanceSessionController::class, 'show']);
    Route::post('/admin/sessions/{id}/manual-attendance', [\App\Http\Controllers\Admin\AttendanceSessionController::class, 'manualAttendance']);
});

Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator/dashboard', function () {
        return 'Dashboard Operator';
    });
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return 'Dashboard Siswa';
    });
});

require __DIR__ . '/auth.php';
