<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\GradeController;
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
Route::apiResource('students', StudentController::class);
Route::apiResource('lectures', LectureController::class);
Route::apiResource('grades', GradeController::class);
Route::put('grades/{grade}/update-plan',[GradeController::class,'updatePlan']);
