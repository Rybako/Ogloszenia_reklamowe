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
        Schema::create('listing_item', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('title');
            $table->string('address');
            $table->string('content');
            $table->string('category');
            $table->integer('user_id'); //id uzytkownika ktory wystawil ogloszenie
            $table->integer('width');
            $table->integer('height');
            $table->integer('price');
            $table->double('position_X'); //do znaczników
            $table->double('position_Y');
            $table->date('add_date');
            $table->date('expiration_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_item');
    }
};
