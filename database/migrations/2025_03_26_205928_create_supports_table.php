<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('support_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('photo')->nullable();
            $table->longText('details')->nullable();
            $table->enum('status', ['Pending', 'Active', 'Processing','Complete','Closed'])->default('Active');
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
        Schema::dropIfExists('supports');
    }
}
