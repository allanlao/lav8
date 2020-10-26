<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveMcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_mc', function (Blueprint $table) {
            $table->string('id',50);
            $table->string('employee_id',50);
            $table->decimal('credit',10,2);
            $table->decimal('balance',10,2);
            $table->string('remarks',50);
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_mc');
    }
}
