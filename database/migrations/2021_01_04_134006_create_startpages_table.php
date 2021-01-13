<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startpages', function (Blueprint $table) {
            $table->id();
            $table->integer('proj_id');
            $table->string('name');
            $table->string('mime_type');
            $table->string('url');
            $table->text('detail')->nullable();
            $table->boolean('status')->default(0);
            $table->datetime('start_datetime')->nullable();
            $table->datetime('stop_datetime')->nullable();
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
        Schema::dropIfExists('startpages');
    }
}
