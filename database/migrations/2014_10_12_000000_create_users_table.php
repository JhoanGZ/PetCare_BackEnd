<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->id()->unique();
        $table->string('user_dni')->unique();
        $table->string('username')->unique();
        $table->string('name');
        $table->string('last_name');
        $table->date('birthdate');
        $table->string('address');
        $table->string('phone_number');
        $table->string('email')->unique();
        $table->string('image')->nullable();
        $table->string('account_status')->default('1');
        $table->string('account_credential')->default('1');
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
