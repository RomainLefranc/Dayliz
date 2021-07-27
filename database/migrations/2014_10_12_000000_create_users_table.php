<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('lastName');
            $table->string('firstName');
            $table->string('email')->unique();
            $table->string('birthDay');
            $table->string('phoneNumber');
            
            $table->string('tokenRandom')->nullable();

            $table->foreignId('role_id');
            $table->foreign("role_id")
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
            $table->foreignId('promotion_id');
            $table->foreign("promotion_id")
                ->references('id')
                ->on('promotions')
                ->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            //$table->string('password');
            $table->rememberToken();
            $table->timestamps();
    
            $table->boolean("state");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
