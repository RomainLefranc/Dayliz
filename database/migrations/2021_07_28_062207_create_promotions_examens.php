<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsExamens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_promotion', function (Blueprint $table) {
            $table->foreignId('promotion_id');
            $table->foreignId('examen_id');
            $table->foreign("promotion_id")->references('id')->on('promotions')->onDelete('cascade');
            $table->foreign("examen_id")->references('id')->on('examens')->onDelete('cascade');
            $table->primary(['promotion_id', 'examen_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examen_promotion');
    }
}
