<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [TodoListController::class, 'LoadViewTodoList']);

Route::post('addtodolist', [TodoListController::class, 'AddTodoList']);

Route::delete('deletetodolist/{id}', [TodoListController::class, 'DeleteTodoList']);

Route::get('alltodolist', [TodoListController::class, 'AllTodoList']);
