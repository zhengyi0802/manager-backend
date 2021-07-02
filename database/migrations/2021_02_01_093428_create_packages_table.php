<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->integer('launcher_id')->default(-1);
            $table->string('name');
            $table->string('icon_url')->nullable();
            $table->string('app_app');
            $table->text('description')->nullable();
            $table->string('package_version')->nullable();
            $table->string('sdk_version')->nullable();
            $table->boolean('status');
            $table->json('type_id')->nullable();
            $table->json('proj_id')->nullable();
            $table->json('mac_addresses')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
