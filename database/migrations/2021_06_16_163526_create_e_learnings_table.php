<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateELearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_learnings', function (Blueprint $table) {
            $table->id();
            $table->integer('catagory_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('preview');
            $table->string('mime_type');
            $table->string('url');
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
        Schema::dropIfExists('e_learnings');
    }
}
