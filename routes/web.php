<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:Staff']], function () {
    // staff routes
    Route::prefix('staff')->group(function () {
        Route::get('/',[StaffController::class,'Staffindex'])->name('staff.index');
        Route::prefix('trainee')->group(function () {
            Route::get('/',[StaffController::class,'Traineeindex'])->name('staff.trainee.index');
            Route::get('add/',[StaffController::class,'getAddTrainee']);
            Route::post('add/',[StaffController::class,'postAddTrainee'])->name('staff.trainee.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateTrainee']);
            Route::post('update/{id}',[StaffController::class,'postUpdateTrainee'])->name('staff.trainee.update');
            Route::get('delete/{id}',[StaffController::class,'deleteTrainee']);
            Route::get('search',[StaffController::class,'searchTrainee'])->name('staff.trainee.search');
        });
        Route::prefix('category')->group(function () {
            Route::get('/',[StaffController::class,'Categoryindex'])->name('staff.category.index');
            Route::get('add/',[StaffController::class,'getAddCategory']);
            Route::post('add/',[StaffController::class,'postAddCategory'])->name('staff.category.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateCategory']);
            Route::post('update/{id}',[StaffController::class,'postUpdateCategory'])->name('staff.category.update');
            Route::get('delete/{id}',[StaffController::class,'deleteCategory']);
            Route::get('search',[StaffController::class,'searchCategory'])->name('staff.category.search');
        });
        Route::prefix('course')->group(function () {
            Route::get('/',[StaffController::class,'Courseindex'])->name('staff.course.index');
            Route::get('add/',[StaffController::class,'getAddCourse']);
            Route::post('add/',[StaffController::class,'postAddCourse'])->name('staff.course.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateCourse']);
            Route::post('update/{id}',[StaffController::class,'postUpdateCourse'])->name('staff.course.update');
            Route::get('delete/{id}',[StaffController::class,'deleteCourse']);
            Route::get('search',[StaffController::class,'searchCourse'])->name('staff.course.search');
        });
        Route::prefix('topic')->group(function () {
            Route::get('/',[StaffController::class,'Topicindex'])->name('staff.topic.index');
            Route::get('add/',[StaffController::class,'getAddTopic']);
            Route::post('add/',[StaffController::class,'postAddTopic'])->name('staff.topic.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateTopic']);
            Route::post('update/{id}',[StaffController::class,'postUpdateTopic'])->name('staff.topic.update');
            Route::get('delete/{id}',[StaffController::class,'deleteTopic']);
        });
        Route::prefix('trainer')->group(function () {
            Route::get('/',[StaffController::class,'Trainerindex'])->name('staff.trainer.index');
            Route::get('add/',[StaffController::class,'getAddTrainer']);
            Route::post('add/',[StaffController::class,'postAddTrainer'])->name('staff.trainer.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateTrainer']);
            Route::post('update/{id}',[StaffController::class,'postUpdateTrainer'])->name('staff.trainer.update');
            Route::get('delete/{id}',[StaffController::class,'deleteTrainer']);
        });
        Route::prefix('assignCourse')->group(function () {
            Route::get('/',[StaffController::class,'AssignCourseindex'])->name('staff.assigncourse.index');
            Route::get('add/',[StaffController::class,'getAddAssignCourse']);
            Route::post('add/',[StaffController::class,'postAddAssignCourse'])->name('staff.assigncourse.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateAssignCourse']);
            Route::post('update/{id}',[StaffController::class,'postUpdateAssignCourse'])->name('staff.assigncourse.update');
            Route::get('delete/{id}',[StaffController::class,'deleteAssignCourse']);
        });
        Route::prefix('assigntopic')->group(function () {
            Route::get('/',[StaffController::class,'AssignTopicindex'])->name('staff.assigntopic.index');
            Route::get('add/',[StaffController::class,'getAddAssignTopic']);
            Route::post('add/',[StaffController::class,'postAddAssignTopic'])->name('staff.assigntopic.add');
            Route::get('update/{id}',[StaffController::class,'getUpdateAssignTopic']);
            Route::post('update/{id}',[StaffController::class,'postUpdateAssignTopic'])->name('staff.assigntopic.update');
            Route::get('delete/{id}',[StaffController::class,'deleteAssignTopic']);
        });
    });
});
