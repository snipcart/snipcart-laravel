<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->string('category');
            $table->decimal('price_per_gram', 8, 3);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
