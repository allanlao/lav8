<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            
            $table->string('employee_id', 50);
            $table->enum('type', ['managerial', 'supervisory', 'technical', 'others']);
            $table->string('title', 100);
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('hours');
            $table->string('sponsor', 100);
            $table->string('encoded_by', 50);
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
        Schema::dropIfExists('trainings');
    }
}
