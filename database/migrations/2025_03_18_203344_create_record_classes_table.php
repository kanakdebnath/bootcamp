<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_classes', function (Blueprint $table) {
            $table->id();
            $table->string('topics')->nullable();
            $table->string('link')->nullable();
            $table->string('password')->nullable();
            $table->enum('status', ['Pending', 'Active', 'InActive'])->default('Active');
            $table->integer('batch_id')->nullable();
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
        Schema::dropIfExists('record_classes');
    }
}
