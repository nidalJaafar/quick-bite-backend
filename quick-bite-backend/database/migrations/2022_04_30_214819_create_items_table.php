<?php

use App\Models\Menu;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('details');
            $table->string('type');
            $table->decimal('base_price');
            $table->integer('sale');
            $table->double('average_rating')->default(0);
            $table->foreignIdFor(Menu::class)->cascadeOnDelete()->cascadeOnUpdate();;
            $table->tinyInteger('is_trending');
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
};
