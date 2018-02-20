<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dlc_id')->nullable();
            $table->string('slug')->unique();
            $table->string('code', 3)->unique();
            $table->string('name');
            $table->integer('base_str');
            $table->integer('base_con');
            $table->integer('base_int');
            $table->integer('base_mnd');
            $table->integer('base_lck');
            $table->text('notes')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('characters');
    }
}
