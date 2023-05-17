<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('business_id', 6)->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->string('company',80)->nullable();
            $table->string('address')->nullable();
            $table->string('cid', 20)->nullable();
            $table->string('pid', 12)->nullable();
            $table->string('pid_image_1')->nullable();
            $table->string('pid_image_2')->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('bank_name', 80)->nullable();
            $table->string('account', 16)->nullable();
            $table->integer('share')->unsigned()->default(500);
            $table->integer('bonus')->unsigned()->default(3500);
            $table->boolean('share_status')->default(true);
            $table->text('memo')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('managers');
    }
}
