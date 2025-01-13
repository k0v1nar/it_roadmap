<?php

namespace App\Components\admin\routes;

use App\Components\admin\achievement\AchievementController;
use Illuminate\Support\Facades\Route;
use App\Components\admin\AdminController;
use App\Components\admin\login\LoginController;
use App\Components\admin\role\RoleController;
use App\Components\admin\admin\AdminProfileController;
use App\Components\admin\user\UserController;
use App\Components\admin\url\StepUrlController;
use App\Components\admin\userAchievement\UserAchievementController;
use App\Components\admin\steps\StepsController;
use App\Components\admin\curs\CursController;

Route::group(['prefix'=>'admin'], function () {
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::group(['middleware' => ['checkEditor']], function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
    Route::group(['middleware' => ['checkSuperAdmin'], 'prefix' => 'admins'], function() {
        Route::get('/', [AdminProfileController::class, 'index'])->name('admin.admin.index');
        Route::get('/add', [AdminProfileController::class, 'add'])->name('admin.admin.add');
        Route::post('/add/confirm', [AdminProfileController::class, 'confirmAdd'])->name('admin.admin.add.confirm');
        Route::get('/edit/{id}', [AdminProfileController::class, 'edit'])->name('admin.admin.edit');
        Route::put('/edit/{id}/confirm', [AdminProfileController::class, 'confirmEdit'])->name('admin.admin.edit.confirm');
        Route::get('/delete/{id}', [AdminProfileController::class, 'delete'])->name('admin.admin.delete');
        Route::delete('/delete/{id}/confirm', [AdminProfileController::class, 'confirmDelete'])->name('admin.admin.delete.confirm');
        Route::get('/{type}/{id}/finish', [AdminProfileController::class, 'finish'])->name('admin.admin.finish');
    });
    Route::group(['middleware' => ['checkSuperAdmin'], 'prefix' => 'roles'], function() {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/add', [RoleController::class, 'add'])->name('admin.role.add');
        Route::post('/add/confirm', [RoleController::class, 'confirmAdd'])->name('admin.role.add.confirm');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::put('/edit/{id}/confirm', [RoleController::class, 'confirmEdit'])->name('admin.role.edit.confirm');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
        Route::delete('/delete/{id}/confirm', [RoleController::class, 'confirmDelete'])->name('admin.role.delete.confirm');
        Route::get('/{type}/{id}/finish', [RoleController::class, 'finish'])->name('admin.role.finish');
    });
    Route::group(['middleware' => ['checkAdmin'], 'prefix' => 'users/achievement'], function() {
        Route::get('/', [UserAchievementController::class, 'index'])->name('admin.user.achievement.index');
        Route::get('/add', [UserAchievementController::class, 'add'])->name('admin.user.achievement.add');
        Route::post('/add/confirm', [UserAchievementController::class, 'confirmAdd'])->name('admin.user.achievement.add.confirm');
        Route::get('/edit/{id}', [UserAchievementController::class, 'edit'])->name('admin.user.achievement.edit');
        Route::put('/edit/{id}/confirm', [UserAchievementController::class, 'confirmEdit'])->name('admin.user.achievement.edit.confirm');
        Route::get('/delete/{id}', [UserAchievementController::class, 'delete'])->name('admin.user.achievement.delete');
        Route::delete('/delete/{id}/confirm', [UserAchievementController::class, 'confirmDelete'])->name('admin.user.achievement.delete.confirm');
        Route::get('/{type}/{id}/finish', [UserAchievementController::class, 'finish'])->name('admin.user.achievement.finish');
    });
    Route::group(['middleware' => ['checkAdmin'], 'prefix' => 'users'], function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/add', [UserController::class, 'add'])->name('admin.user.add');
        Route::post('/add/confirm', [UserController::class, 'confirmAdd'])->name('admin.user.add.confirm');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/edit/{id}/confirm', [UserController::class, 'confirmEdit'])->name('admin.user.edit.confirm');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::delete('/delete/{id}/confirm', [UserController::class, 'confirmDelete'])->name('admin.user.delete.confirm');
        Route::get('/{type}/{id}/finish', [UserController::class, 'finish'])->name('admin.user.finish');
    });  
    Route::group(['middleware' => ['checkEditor'], 'prefix' => 'steps'], function() {
        Route::get('/', [StepsController::class, 'index'])->name('admin.steps.index');
        Route::get('/add', [StepsController::class, 'add'])->name('admin.steps.add');
        Route::post('/add/confirm', [StepsController::class, 'confirmAdd'])->name('admin.steps.add.confirm');
        Route::get('/edit/{id}', [StepsController::class, 'edit'])->name('admin.steps.edit');
        Route::put('/edit/confirm', [StepsController::class, 'confirmEdit'])->name('admin.steps.edit.confirm');
        Route::get('/delete/{id}', [StepsController::class, 'delete'])->name('admin.steps.delete');
        Route::delete('/delete/confirm', [StepsController::class, 'confirmDelete'])->name('admin.steps.delete.confirm');
        Route::get('/finish/{type}/{id}', [StepsController::class, 'finish'])->name('admin.steps.finish');
        Route::post('/get-steps-by-course', [StepsController::class, 'getStepsByCourse'])->name('admin.steps.get-by-course');
    });    
    Route::group(['middleware' => ['checkEditor'], 'prefix' => 'steps/urls'], function() {
        Route::get('/', [StepUrlController::class, 'index'])->name('admin.steps.urls.index');
        Route::get('/add', [StepUrlController::class, 'add'])->name('admin.steps.urls.add');
        Route::post('/add/confirm', [StepUrlController::class, 'confirmAdd'])->name('admin.steps.urls.add.confirm');
        Route::get('/edit/{id}', [StepUrlController::class, 'edit'])->name('admin.steps.urls.edit');
        Route::put('/edit/confirm', [StepUrlController::class, 'confirmEdit'])->name('admin.steps.urls.edit.confirm');
        Route::get('/delete/{id}', [StepUrlController::class, 'delete'])->name('admin.steps.urls.delete');
        Route::delete('/delete/confirm', [StepUrlController::class, 'confirmDelete'])->name('admin.steps.urls.delete.confirm');
        Route::get('/finish/{type}/{id}', [StepUrlController::class, 'finish'])->name('admin.steps.urls.finish');
    });
    Route::group(['middleware' => ['checkEditor'], 'prefix' => 'achievements'], function() {
        Route::get('/', [AchievementController::class, 'index'])->name('admin.achievement.index');
        Route::get('/add', [AchievementController::class, 'add'])->name('admin.achievement.add');
        Route::post('/add/confirm', [AchievementController::class, 'confirmAdd'])->name('admin.achievement.add.confirm');
        Route::get('/edit/{id}', [AchievementController::class, 'edit'])->name('admin.achievement.edit');
        Route::put('/edit/{id}/confirm', [AchievementController::class, 'confirmEdit'])->name('admin.achievement.edit.confirm');
        Route::get('/delete/{id}', [AchievementController::class, 'delete'])->name('admin.achievement.delete');
        Route::delete('/delete/{id}/confirm', [AchievementController::class, 'confirmDelete'])->name('admin.achievement.delete.confirm');
        Route::get('/{type}/{id}/finish', [AchievementController::class, 'finish'])->name('admin.achievement.finish');
    });
    Route::group(['middleware' => ['checkEditor'], 'prefix' => 'curs'], function() {
        Route::get('/', [CursController::class, 'index'])->name('admin.curs.index');
        Route::get('/add', [CursController::class, 'add'])->name('admin.curs.add');
        Route::post('/add/confirm', [CursController::class, 'confirmAdd'])->name('admin.curs.add.confirm');
        Route::get('/edit/{id}', [CursController::class, 'edit'])->name('admin.curs.edit');
        Route::put('/edit/{id}/confirm', [CursController::class, 'confirmEdit'])->name('admin.curs.edit.confirm');
        Route::get('/delete/{id}', [CursController::class, 'delete'])->name('admin.curs.delete');
        Route::delete('/delete/{id}/confirm', [CursController::class, 'confirmDelete'])->name('admin.curs.delete.confirm');
        Route::get('/{type}/{id}/finish', [CursController::class, 'finish'])->name('admin.curs.finish');
    });    
});

?>
