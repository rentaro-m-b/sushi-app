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
        if(!Schema::hasTable('item_options')){
            Schema::create('item_options', function (Blueprint $table) {
                $table->id();
                $table->foreignId('item_id')->constrained();
                $table->foreignId('option_id')->constrained();
                $table->boolean('on_sale');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_options');
    }
};
