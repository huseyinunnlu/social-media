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
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('fullname');
            $table->string('password');
            $table->string('image');
            $table->string('bio')->nullable();
            $table->date('birth')->nullable();
            $table->enum('gender',[0,1,2])->default(0);
            $table->enum('acctype',[0,1])->default(0);
            $table->datetime('email_verified_at')->nullable();
            $table->datetime('phone_verified_at')->nullable();
            $table->boolean('isEmailVerified')->default(false);
            $table->boolean('isPhoneVerified')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
