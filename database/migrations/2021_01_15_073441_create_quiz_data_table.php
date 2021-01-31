<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->uniqid();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->json('qustion_answer');
            $table->string('catagory');
            $table->foreign('catagory')->references('catagory')->on('quiz_catagories')->onDelete('cascade');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('quiz_data');
    }
}
