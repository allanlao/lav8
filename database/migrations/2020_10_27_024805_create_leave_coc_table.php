<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveCocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_coc', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id',50);
            $table->date('date_issued');
            $table->string('description');
            $table->enum('type',['coc','cto']);
            $table->date('osr_from');
            $table->date('osr_to');
            $table->integer('hours');
            $table->integer('balance');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_coc');
    }
}
