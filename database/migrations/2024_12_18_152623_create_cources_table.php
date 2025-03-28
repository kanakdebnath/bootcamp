<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourcesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cources', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('title')->nullable();
            $table->string('photo')->nullable();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('duration')->nullable();
            $table->text('start_date')->nullable();
            $table->text('price')->nullable();
            $table->text('offer_price')->nullable();
            $table->text('course_type')->nullable();
            $table->date('class_one_date')->nullable();
            $table->string('class_one_link')->nullable();
            $table->date('class_two_date')->nullable();
            $table->string('class_two_link')->nullable();
            $table->date('class_three_date')->nullable();
            $table->string('class_three_link')->nullable();
            $table->date('class_four_date')->nullable();
            $table->string('class_four_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cources');
    }
}
