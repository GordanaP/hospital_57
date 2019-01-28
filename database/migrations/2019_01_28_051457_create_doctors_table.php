<?php

use App\Services\Utilities\Color;
use App\Services\Utilities\Specialty;
use App\Services\Utilities\Title;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null');

            $table->string('first_name');
            $table->string('last_name');
            $table->enum('title', Title::names());
            $table->enum('specialty', Specialty::names());
            $table->string('license')->nullable();
            $table->text('biography')->nullable();
            $table->enum('color', Color::names())->nullable();
            $table->unsignedInteger('app_slot')->default(30)->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
