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
        Schema::create('listings', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('title');
            $table->string('owner'); //email autora ogłoszenia
            $table->integer('width');
            $table->integer('height');
            $table->integer('price');
            $table->string('address');
            $table->double('X'); //do znaczników
            $table->double('Y');
            $table->date('date');
            $table->date('expiration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
