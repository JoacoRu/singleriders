<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablasSql extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table){
            $table->increments('image_id')->index();
            $table->smallInteger('user_id');
            $table->text('src');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->smallInteger('from_id');
            $table->smallInteger('to_id');
            $table->text('message');
            $table->increments('message_id')->index();
            $table->dateTime('message_created_at');
        });
    

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('post_id')->index();
            $table->smallInteger('user_id');
            $table->text('post');
            $table->timestamps();
        });

        Schema::create('travels', function (Blueprint $table){
            $table->increments('travel_id')->index();
            $table->date('dateIn');
            $table->date('dateOut');
            $table->string('country', 100);
            $table->text('activities')->nullable();
            $table->string('city', 100);
            $table->text('msgInti')->nullable();
            $table->smallInteger('amount');
            $table->string('coin', 50);
            $table->smallInteger('user_id');
        });

        Schema::create('countries', function (Blueprint $table){
            $table->string('cities', 100);
            $table->string('country_code', 100);
        });

        Schema::create('cities', function (Blueprint $table){
            $table->string('city', 100);
            $table->string('city_code_country', 100);
        });

        Schema::create('likes', function (Blueprint $table){
            $table->increments('like_id')->index();
            $table->string('post_id');
            $table->string('user_id');
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
        Schema::dropIfExists('images');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('travels');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('likes');

    }
    
}
