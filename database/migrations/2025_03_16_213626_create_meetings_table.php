<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('topics')->nullable();
            $table->string('link')->nullable();
            $table->string('time')->nullable();
            $table->enum('status', ['Not Started', 'Started', 'ReSchedule',  'Complete'])->default('Not Started');
            $table->string('date')->nullable();
            $table->longText('description')->nullable();
            $table->integer('batch_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('zoom_id')->nullable();
            $table->string('zoom_pass')->nullable();
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
        Schema::dropIfExists('meetings');
    }
}
