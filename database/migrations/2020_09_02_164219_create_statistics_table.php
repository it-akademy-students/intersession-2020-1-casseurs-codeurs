<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('errorsFound')->default(0);
            $table->integer('securityFails')->default(0);
            $table->integer('scannedFiles')->default(0);
            $table->integer('repositoryScanned')->default(0);
            $table->integer('migrationAssistance')->default(0);
            $table->integer('donations')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
