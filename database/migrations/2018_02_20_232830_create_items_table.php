<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->unsignedInteger('item_type_id');
            $table->string('name');
            $table->string('description');
            $table->integer('rarity')->default(1);
            $table->boolean('is_starter')->default(false);
            $table->boolean('is_shoppable')->default(false);
            $table->integer('value')->nullable();
            $table->integer('stat_atk')->default(0);
            $table->integer('stat_def')->default(0);
            $table->integer('stat_str')->default(0);
            $table->integer('stat_con')->default(0);
            $table->integer('stat_int')->default(0);
            $table->integer('stat_mnd')->default(0);
            $table->integer('stat_lck')->default(0);
            $table->integer('stat_hp')->default(0);
            $table->integer('stat_mp')->default(0);
            $table->integer('resistance_strike')->default(0);
            $table->integer('resistance_slash')->default(0);
            $table->integer('resistance_pierce')->default(0);
            $table->integer('resistance_fire')->default(0);
            $table->integer('resistance_ice')->default(0);
            $table->integer('resistance_lightning')->default(0);
            $table->integer('resistance_petrify')->default(0);
            $table->integer('resistance_holy')->default(0);
            $table->integer('resistance_darkness')->default(0);
            $table->integer('resistance_curse')->default(0);
            $table->integer('resistance_poison')->default(0);
            $table->string('attribute1')->nullable();
            $table->string('attribute2')->nullable();
            $table->boolean('is_consumable')->default(false);
            $table->boolean('is_consumed_over_time')->default(false);
            $table->unsignedInteger('dlc_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('item_type_id')->references('id')->on('item_types');
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
        Schema::dropIfExists('items');
    }
}
