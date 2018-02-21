<?php

use App\Helpers\AttributeHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /** @var AttributeHelper */
    protected $attributeHelper;

    /**
     * CreateItemsTable constructor.
     */
    public function __construct()
    {
        $this->attributeHelper = app(AttributeHelper::class);
    }

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

            foreach ($this->attributeHelper->getAttributes() as $attribute) {
                $table->integer('resistance_' . $attribute)->default(0);
            }

            $table->enum('attribute1', $this->attributeHelper->getAttributes())->nullable();
            $table->enum('attribute2', $this->attributeHelper->getAttributes())->nullable();
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
