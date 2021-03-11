<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 14, 2);
            $table->dateTime('action_date');
            $table->string('action_type');
            $table->timestamps();
            $table->boolean('is_except')->default(0);
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
            $table->foreignId('trade_id')->nullable()->constrained('trades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance');
    }
}
