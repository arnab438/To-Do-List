<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoAppController;

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
    return redirect('tasks');
});

Route::get('tasks',[TodoAppController::class, 'showTasks'])->name('tasks');
// Route::get('create-task',[TodoAppController::class, 'taskEntryForm'])->name('task.create');
Route::post('create-task',[TodoAppController::class, 'createTask'])->name('task.store');
Route::delete('delete-task/{id}',[TodoAppController::class, 'deleteTask'])->name('task.delete');
Route::post('tasks/{id}/complete', [TodoAppController::class, 'completeTask'])->name('task.complete');

