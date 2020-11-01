<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->string('id',50)->index();;
          
            $table->string('firstname', 50);
            $table->string('middlename', 50)->nullable();
            $table->string('lastname', 50);
            $table->string('username')->unique()->nullable();
            $table->text('password')->nullable();
          
            $table->integer('position_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->date('entrance_to_duty')->nullable();
     
            $table->string('gsis_no')->nullable();
            $table->string('tin')->nullable();

            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('civil_status', ['single', 'married', 'widowed', 'divorced'])->default('single');
         
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('employment_status', ['probationary', 'regular', 'permanent', 'resigned', 'terminated'])->default('probationary');
         
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->string('encoded_by',50)->nullable();
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
        Schema::dropIfExists('employees');
    }
}
