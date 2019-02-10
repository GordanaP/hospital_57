<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');

            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['M', 'F']);
            $table->date('birthday');
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
