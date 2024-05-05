<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileTeacherController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AppointmentAvailableController;
use App\Http\Controllers\AppointmentTeacherStudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\GovernorController;
use App\Http\Controllers\ProfileStudentController;
use App\Http\Controllers\IntrestController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\QualificationCourseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestCompleteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceTeacherController;
use App\Http\Controllers\Teacher\CalendarController;
use App\Http\Controllers\TeachingMethodController;
use App\Http\Controllers\TeachingMethodUserController;
use App\Http\Controllers\User\CompleteController;
use App\Http\Controllers\User\LockHourController;
use App\Http\Controllers\WalletController;
use App\Models\Wallet;
use Spatie\Permission\Contracts\Permission;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::group(['prefix' => 'profile_teacher'], function () {
        Route::post('store', [ProfileTeacherController::class, 'store']);
        Route::post('update', [ProfileTeacherController::class, 'update']);
        Route::get('getById/{id}', [ProfileTeacherController::class, 'getById']);
        Route::get('getmyProfile', [ProfileTeacherController::class, 'show']);
        Route::get('index', [ProfileTeacherController::class, 'index']);
    });

    Route::group(['prefix' => 'profile_student'], function () {
        Route::post('store', [ProfileStudentController::class, 'store']);
        Route::post('update', [ProfileStudentController::class, 'update']);
        Route::get('getById/{id}', [ProfileStudentController::class, 'getById']);
        Route::get('getmyProfile', [ProfileStudentController::class, 'show']);
        Route::get('getAll', [ProfileStudentController::class, 'getAll']);
    });

    Route::group(['prefix' => 'ads'], function () {
        Route::post('store', [AdsController::class, 'store']);
        Route::post('update/{id}', [AdsController::class, 'update']);
        Route::delete('delete/{id}', [AdsController::class, 'destroy']);
        Route::get('getAll', [AdsController::class, 'index']);
        Route::get('getById/{id}', [AdsController::class, 'getById']);
        Route::get('getAdsTeacher/{id}', [AdsController::class, 'getAdsTeacher']);
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::post('store', [EmployeeController::class, 'createEmployee']);
        Route::post('update/{id}', [EmployeeController::class, 'updateEmployee']);
        Route::get('getById/{id}', [EmployeeController::class, 'getById']);
        Route::delete('delete/{id}', [EmployeeController::class, 'delete']);
    });

    Route::group(['prefix' => 'evaluation'], function () {
        Route::post('store', [EvaluationController::class, 'store']);
        Route::delete('delete/{id}', [EvaluationController::class, 'destroy']);
    });

    Route::group(['prefix' => 'intrest'], function () {
        Route::post('store', [IntrestController::class, 'store']);
        Route::post('update/{id}', [IntrestController::class, 'update']);
        Route::delete('delete/{id}', [IntrestController::class, 'destroy']);
        Route::get('getMyIntrests', [IntrestController::class, 'getMyIntrests']);
    });

    Route::group(['prefix' => 'note'], function () {
        Route::post('store', [NoteController::class, 'store']);
        Route::delete('delete/{id}', [NoteController::class, 'destroy']);
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::post('store', [PermissionController::class, 'create']);
        Route::post('update/{id}', [PermissionController::class, 'update']);
        Route::get('getall', [PermissionController::class, 'getAll']);
        Route::get('getById/{id}', [PermissionController::class, 'getById']);
        Route::delete('delete/{id}', [PermissionController::class, 'delete']);
    });



    Route::group(['prefix' => 'report'], function () {
        Route::get('get', [ReportController::class, 'index']);
        Route::post('report_student', [ReportController::class, 'report_student']);
    });


    Route::group(['prefix' => 'role'], function () {
        Route::post('store', [RoleController::class, 'create']);
        Route::post('update/{id}', [RoleController::class, 'update']);
        Route::delete('delete/{id}', [RoleController::class, 'delete']);
    });

    Route::group(['prefix' => 'ServiceTeacher'], function () {
        Route::post('store', [ServiceTeacherController::class, 'store']);
        Route::post('update/{id}', [ServiceTeacherController::class, 'update']);
        Route::delete('delete/{id}', [ServiceTeacherController::class, 'destroy']);
        Route::get('getAll/{id}', [ServiceTeacherController::class, 'index']);
        Route::get('getById/{id}', [ServiceTeacherController::class, 'show']);
    });


    Route::group(['prefix' => 'TeachingMethod'], function () {
        Route::get('getById/{id}', [TeachingMethodController::class, 'show']);
        Route::post('store', [TeachingMethodController::class, 'store']);
        Route::post('update/{id}', [TeachingMethodController::class, 'update']);
        Route::delete('delete/{id}', [TeachingMethodController::class, 'destroy']);
        Route::get('getAll/{id}', [TeachingMethodController::class, 'index']);
    });


    Route::group(['prefix' => 'TeachingMethodUser'], function () {
        Route::post('store', [TeachingMethodUserController::class, 'store']);
        Route::delete('delete/{id}', [TeachingMethodUserController::class, 'destroy']);
        Route::get('getMyTeachingMethod', [TeachingMethodUserController::class, 'getMyTeachingMethod']);
    });




    //  khadr
    Route::group(['prefix' => 'transactions-wallet'], function () {
        Route::get('get-request-charge', [GovernorController::class, 'get_request_charge']);
        Route::get('get-request-recharge', [GovernorController::class, 'get_request_recharge']);
        Route::post('store', [GovernorController::class, 'store']);
        Route::get('show-my-request', [GovernorController::class, 'show']);
        Route::delete('delete-request/{id}', [GovernorController::class, 'destroy']);
        Route::get('accept_request_charge/{id}', [GovernorController::class, 'accept_request_charge']);
        Route::get('accept_request_recharge/{id}', [GovernorController::class, 'accept_request_recharge']);
    });

    //  khader
    Route::group(['prefix' => 'request-complete'], function () {

        Route::get('get-request-teacher', [CompleteController::class, 'get_request_teacher']);
        Route::get('get-request-student', [CompleteController::class, 'get_request_student']);
        Route::post('store', [CompleteController::class, 'store']);
        Route::delete('delete-request-complete/{id}', [CompleteController::class, 'destroy']);
        Route::get('accept_request_complete_teacher/{id}', [CompleteController::class, 'accept_request_complete_teacher']);
        Route::get('accept_request_complete_student/{id}', [CompleteController::class, 'accept_request_complete_student']);
    });

    // Admin khader
    Route::group(['prefix' => 'request-join'], function () {
        Route::get('get', [AdminController::class, 'index']);
        Route::delete('delete-request-join/{id}', [AdminController::class, 'destroy']);
        Route::get('accept-request-join/{id}', [AdminController::class, 'accept_request_teacher']);
        Route::get('get-teacher', [AdminController::class, 'get_all_teacher']);
        Route::get('get-student', [AdminController::class, 'get_all_student']);
        Route::get('count-student', [AdminController::class, 'count_student']);
        Route::get('count-teacher', [AdminController::class, 'count_teacher']);
        Route::delete('delete-teacher/{id}', [AdminController::class, 'destroy_teacher']);
        Route::delete('delete-student/{id}', [AdminController::class, 'destroy_student']);
    });
    Route::group(['prefix' => 'block-list'], function () {
        Route::get('get', [BlockController::class, 'index']);
        Route::post('store/{id}', [BlockController::class, 'store']);
        Route::delete('unblock-user/{id}', [BlockController::class, 'destroy']);
    });

    //khader

    Route::group(['prefix' => 'QualificationCourse'], function () {
        // Route::group(['middleware' => ['role:admin']], function () {
        Route::post('store', [QualificationCourseController::class, 'store']);
        Route::post('insert_into_courses/{id}', [QualificationCourseController::class, 'insert_into_courses']);
        Route::post('update/{id}', [QualificationCourseController::class, 'update']);
        Route::delete('delete/{id}', [QualificationCourseController::class, 'destroy']);
        Route::get('getall', [QualificationCourseController::class, 'index']);
        Route::get('getById/{id}', [QualificationCourseController::class, 'show']);
        // });
        Route::get('show_my_courses', [QualificationCourseController::class, 'show_my_courses']);
    });

    // CLAENDER khader

    Route::group(['prefix' => 'calender'], function () {
        Route::post('store', [CalendarController::class, 'store']);
        Route::get('get', [CalendarController::class, 'index']);
        Route::get('getById/{id}', [CalendarController::class, 'show']);

        Route::post('lock-hour', [LockHourController::class, 'store']);

        Route::get('user_lock', [LockHourController::class, 'index']);
        Route::delete('delete/{id}', [LockHourController::class, 'destroy']);
        Route::get('show_my_request', [LockHourController::class, 'get_my_request']);

        Route::post('update/{id}', [QualificationCourseController::class, 'update']);
    });
});

// Route::get('insert-teacher', [AdminController::class, 'insert_teacher']);
