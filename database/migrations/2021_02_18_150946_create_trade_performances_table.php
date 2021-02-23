<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_performances', function (Blueprint $table) {
            $table->id();
            $table->decimal('trade_return', 9,2);
            $table->decimal('ratio', 14, 2)->nullable();
            $table->decimal('pow_2', 14, 5)->nullable();
            $table->foreignId('trade_id')->constrained('trades')->onDelete('cascade');
            $table->foreignId('portfolio_id')->constrained('portfolios')->onDelete('cascade');
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
        Schema::dropIfExists('trade_performances');
    }
}
