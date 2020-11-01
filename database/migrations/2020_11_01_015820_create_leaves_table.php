<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->date('date_filed');
            $table->string('employee_id', 50);
            $table->enum('type', ['sick', 'vacation', 'maternity', 'paternity']);

            $table->string('location', 50);
            $table->enum('location_type', ['local', 'abroad', 'hospital', 'paternity']);
            $table->integer('total_days');
            $table->string('inclusive_dates', 50);
            $table->enum('commutation', ['requested', 'none']);

       
            $table->integer('total_approved_with_pay');
            $table->integer('total_approved_without_pay');
            $table->integer('total_approved_others');

            $table->decimal('vl_balance', 3);
            $table->decimal('sl_balance', 3);
            $table->string('disapproved_reason', 50)->nullable();

            $table->timestamps();
            $table->string('encoded_by', 50)->nullable();
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
        Schema::dropIfExists('leaves');
    }
}
