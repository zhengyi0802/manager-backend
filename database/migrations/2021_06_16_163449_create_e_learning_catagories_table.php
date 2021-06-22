<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateELearningCatagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_learning_catagories', function (Blueprint $table) {
            $table->id();
            $table->integer('proj_id');
            $table->integer('parent_id')->default(0);
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('preview');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_learning_catagories');
    }
}
