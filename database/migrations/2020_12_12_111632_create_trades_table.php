<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->string('type_side');
            $table->decimal('quantity', 16, 0);
            $table->decimal('entry_price', 14, 5);
            $table->decimal('exit_price', 14, 5);
            $table->decimal('stop_loss_price', 14, 5);
            $table->string('time_frame');
            $table->dateTime('entry_date');
            $table->dateTime('exit_date');
            $table->decimal('pl_currency', 11, 2);
            $table->decimal('pl_pips', 14, 2);
            $table->decimal('fees', 14, 2)->nullable();
            $table->text('trade_notes')->nullable();
            $table->string('trade_img')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
            $table->foreignId('exit_reason_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('entry_rule_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('strategy_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('trades');
    }
}
