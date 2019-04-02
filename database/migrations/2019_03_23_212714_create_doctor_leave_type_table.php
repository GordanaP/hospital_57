<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorLeaveTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_leave_type', function (Blueprint $table) {
            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')
                ->on('doctors')->onDelete('cascade');

            $table->unsignedInteger('leave_type_id');
            $table->foreign('leave_type_id')->references('id')
                ->on('leave_types')->onDelete('cascade');

            $table->unsignedInteger('year')->nullable();
            $table->unsignedInteger('total')->nullable();

            $table->unique(['doctor_id', 'leave_type_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_leave_type');
    }
}
