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
        if(!Schema::hasTable('paid_logs_items')){
            Schema::create('paid_logs_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('paid_log_id')->constrained();
                $table->foreignId('order_id')->constrained();
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
        Schema::dropIfExists('paid_logs_items');
    }
};
