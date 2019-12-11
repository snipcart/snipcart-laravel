<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesAndRelation extends Migration
{
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('size');
            $table->timestamps();
        });
        
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->uuid('recipe_id')->index();
            $table->bigInteger('ingredient_id')->unsigned()->index();

            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');

            $table->decimal('quantity', 5, 3);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredient_recipe');
        Schema::dropIfExists('recipes');
    }
}
