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
            $table->enum('type', ['plate', 'sandwich', 'dessert', 'drink']);
            $table->decimal('base_price');
            $table->integer('sale');
            $table->double('average_rating');
            $table->foreignIdFor(Menu::class);
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
        Schema::dropIfExists('table_items');
    }
};
