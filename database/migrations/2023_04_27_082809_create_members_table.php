<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('introducer_id')->unsigned()->default(2);
            $table->string('address');
            $table->string('pid', 12);
            $table->string('bank', 50)->nullable();
            $table->string('bank_name',80)->nullable();
            $table->string('account', 16)->nullable();
            $table->integer('bonus')->unsigned()->default(0);
            $table->integer('share')->unsigned()->default(0);
            $table->string('creadit_card', 16)->nullable();
            $table->date('creadit_expire')->nullable();
            $table->string('pid_image_1')->nullable();
            $table->string('pid_image_2')->nullable();
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
        Schema::dropIfExists('members');
    }
}
