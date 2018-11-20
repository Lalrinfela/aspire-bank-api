<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repayments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->double('amount', 14, 2);
            $table->dateTime('paid_on');
            $table->string('payment_type')->default('online'); // online, in-cash, cheque
            $table->double('amount_balance', 14, 2);
            $table->integer('frequency_balance');
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
        Schema::dropIfExists('repayments');
    }
}
