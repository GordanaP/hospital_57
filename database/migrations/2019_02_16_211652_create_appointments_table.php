<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')
                ->on('doctors')->onDelete('cascade');

            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')
                ->on('patients')->onDelete('cascade');

            $table->timestamp('start_at')->nullable()->default(NULL);
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
        Schema::dropIfExists('appointments');
    }
}
