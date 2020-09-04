<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyseModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('repository');
            $table->integer('errorsFound');
            $table->integer('maxErrorsFound');
            $table->integer('totalErrorsFound');
            $table->integer('securityFails');
            $table->integer('maxSecurityFails');
            $table->integer('totalSecurityFails');
            $table->integer('scannedFiles');
            $table->integer('numberOfScans');
            $table->json('files');
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
        Schema::dropIfExists('analyses');
    }
}
