<?php

namespace App\Components\users\routes;

use App\Components\user\auth\AuthController;
use App\Components\user\registration\RegistrationController;
use App\Components\user\main\MainController;
use App\Components\user\profile\settings\ProfileSettingsController;
use App\Components\user\profile\courses\ProfileCoursesController;
use App\Components\user\courses\CoursesController;
use Illuminate\Support\Facades\Route;

Route::get("/", [MainController::class, "index"])->name('main');
Route::get("/login", [AuthController::class, "index"])->name('login.index');
Route::post("/login", [AuthController::class, "login"])->name('login');
Route::get("/registration", [RegistrationController::class, "index"])->name('registration.index');
Route::post("/registration", [RegistrationController::class, "registrate"])->name('registration');
Route::post("/logout", [AuthController::class, "logout"])->name('logout');
Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CoursesController::class, 'show'])->name('courses.course.index');
Route::group(['middleware'=>'checkClient'], function() {
    Route::get('/profile/settings', [ProfileSettingsController::class, "index"])->name('profile.settings.index');
    Route::put('/profile/settings/update', [ProfileSettingsController::class, "update"])->name('profile.settings.update');
    Route::get('/profile/courses', [ProfileCoursesController::class, 'index'])->name('profile.courses.index');
    Route::get('/profile/courses/{course}', [ProfileCoursesController::class, 'show'])->name('profile.courses.course.index');
    Route::post('/profile/courses/add/{course}', [ProfileCoursesController::class, 'add'])->name('profile.courses.course.add');
});
?>