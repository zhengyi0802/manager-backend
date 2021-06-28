<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp');
            $table->string('version_code', 20);
            $table->string('version_name', 20);
            $table->string('android', 20);
            $table->string('mac_eth', 20);
            $table->string('mac_wifi', 20);
            $table->string('sn', 30);
            $table->text('data');
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
        Schema::dropIfExists('log_messages');
    }
}
