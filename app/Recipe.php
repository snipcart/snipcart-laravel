<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($recipe) {
            $recipe->{$recipe->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')
            ->using('App\IngredientRecipe')
            ->withPivot(['quantity']);
    }
}
