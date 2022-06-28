<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('health_packages_id');
            $table->integer('users_id')->nullable();
            $table->integer('additional');
            $table->integer('transaction_total');
            $table->enum('transaction_status', ['IN_CART', 'PENDING', 'SUCCESS', 'CANCEL_REFUND', 'CANCEL', 'FAILED', 'REFUNDED']); //IN_CART, PENDING, SUCCESS, CANCEL FAILED
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
