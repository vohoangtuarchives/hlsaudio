<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatevideoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->integer('index')->default(1);
            $table->enum('visibility', ['hide', 'show'])->default('show');

            $table->string("path")->nullable();
            $table->text("content")->nullable();
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('customer_id')->references('id')->on('customers');



            //$table->enum('status', ['pending', 'completed'])->default('pending');


            //$table->foreignId('playlist_id')->references('id')->on('playlists');

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
        Schema::dropIfExists('videos');
    }
}
