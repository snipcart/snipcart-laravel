<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ingredients', [IngredientController::class,'index']);
Route::get('/recipe/{id}', [RecipeController::class, 'fetch']);

Route::post('/recipes', [RecipeController::class, 'save']);
Route::post('/recipes/preview', [RecipeController::class, 'preview']);

