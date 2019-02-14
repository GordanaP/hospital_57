<?php

use App\Services\Utilities\Absence;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onDelete('cascade');

            $table->date('start_at');
            $table->date('end_at')->nullable();

            $table->enum('description', Absence::names());

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
        Schema::dropIfExists('absences');
    }
}
