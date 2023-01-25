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
            $table->string('title', 50);
            $table->string('address', 70);
            $table->string('content', 1000);
            $table->string('category');
            $table->integer('user_id'); //id uzytkownika ktory wystawil ogloszenie
            $table->float('width', 5, 2);
            $table->float('height' , 5, 2);
            $table->float('price', 10, 2);
            $table->double('position_X'); //do znaczników
            $table->double('position_Y');
            $table->date('add_date');
            $table->date('expiration_date');
            $table->boolean('blocked')->nullable()->default(false);
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
