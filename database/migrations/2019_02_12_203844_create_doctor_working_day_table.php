<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorWorkingDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_working_day', function (Blueprint $table) {

            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')
                ->on('doctors')->onDelete('cascade');

            $table->unsignedInteger('working_day_id');
            $table->foreign('working_day_id')->references('id')
                ->on('working_days')->onDelete('cascade');

            $table->string('start_at')->nullable();
            $table->string('end_at')->nullable();

            $table->unique(['doctor_id', 'working_day_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_working_day');
    }
}
