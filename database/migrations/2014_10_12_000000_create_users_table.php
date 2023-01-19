<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name', 30);
            $table->string('email', 40)->unique();
            $table->timestamp('email_verified_at')->nullable(); //data weryfikacji konta
            $table->string('password');
            $table->string('role')->nullable()->default("user"); //user, admin
            $table->string('phone_number', 11); //123-123-123
            $table->boolean('blocked')->nullable()->default(false); //konto domyślnie nie jest zablokowane
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
};
