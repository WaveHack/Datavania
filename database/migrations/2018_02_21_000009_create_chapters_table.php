<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->integer('chapter');
            $table->string('name');
            $table->integer('chests_blue')->default(0);
            $table->integer('chests_brown')->default(0);
            $table->integer('chests_green')->default(0);
            $table->integer('chests_red')->default(0);
            $table->integer('chests_purple')->default(0);
            $table->unsignedInteger('hidden_item_id')->nullable();
            $table->unsignedInteger('stage_music_id')->nullable();
            $table->unsignedInteger('boss_music_id')->nullable();
            $table->unsignedInteger('boss2_music_id')->nullable();
            $table->unsignedInteger('dlc_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('hidden_item_id')->references('id')->on('items');
            $table->foreign('stage_music_id')->references('id')->on('music');
            $table->foreign('boss_music_id')->references('id')->on('music');
            $table->foreign('boss2_music_id')->references('id')->on('music');
            $table->foreign('dlc_id')->references('id')->on('dlcs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}
