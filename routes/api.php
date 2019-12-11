<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ingredients', 'IngredientController@index');

Route::post('/recipes', 'RecipeController@save');
Route::post('/recipes/preview', 'RecipeController@preview');
