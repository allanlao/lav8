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
            $table->increments('id');
            $table->string('employee_id',50);
            $table->date('period');
            $table->enum('type',['vl','sl']);
            $table->decimal('credit',10,2);
            $table->decimal('balance',10,2);
            $table->string('remarks',50)->nullable();
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
        Schema::dropIfExists('leave_mc');
    }
}
