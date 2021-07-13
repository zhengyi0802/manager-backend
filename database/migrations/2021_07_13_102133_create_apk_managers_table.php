<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApkManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apk_managers', function (Blueprint $table) {
            $table->id();
            $table->integer('launcher_id')->default(-1);
            $table->string('label', 50);
            $table->string('package_name', 50);
            $table->string('package_version_name', 30);
            $table->string('package_version_code', 30);
            $table->string('sdk_version', 10);
            $table->string('icon');
            $table->string('path');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('apk_managers');
    }
}
