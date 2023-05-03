<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->Integer('id')->unsigned()->unique();
            $table->bigInteger('member_id')->unsigned();
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('model')->unsigned()->default(1);
            $table->integer('prepaid_paid')->unsigned()->default(0);
            $table->date('paid_date')->nullable();
            $table->mediumInteger('prepaid_unpaid')->unsigned()->default(3500);
            $table->tinyInteger('flow_status')->unsigned()->default(1);
            $table->text('memo')->nullable();
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('orders');
    }
}
