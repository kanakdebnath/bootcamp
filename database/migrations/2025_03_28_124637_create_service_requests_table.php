<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id')->nullable();
            $table->string('order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->double('price')->nullable();
            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->enum('status', ['Pending', 'Active', 'Processing','Complete'])->default('Pending');
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
        Schema::dropIfExists('service_requests');
    }
}
