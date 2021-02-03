<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IngredientController extends Controller
{
    public function index()
    {
        return response()->json(Ingredient::all()->jsonSerialize());
    }
}
