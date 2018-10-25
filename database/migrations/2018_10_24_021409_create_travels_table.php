<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('dateIn');
            $table->date('dateOut');
            $table->string('country', 100);
            $table->text('activities')->nullable();
            $table->string('city', 100);
            $table->text('msgIti')->nullable();
            $table->Integer('amount');
            $table->string('coin', 50);
            $table->Integer('travel_creator');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travels');
    }
}
