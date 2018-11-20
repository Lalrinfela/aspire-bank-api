<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->double('amount', 14, 2); // 14 digits with 2 decimal inclusive.
            $table->float('duration', 5, 2)->default(3); // 5 digits with 2 decimal inclusive (In Months)
            $table->integer('frequency')->default(3); // No of months
            $table->float('interest_rate', 5, 2);
            $table->double('interest_amount', 14, 2);
            $table->double('arrangement_fee', 8, 2);
            $table->double('total_amount', 14, 2); //amount + interest amount + arrangement fee
            $table->date('opening');
            $table->integer('frequency_paid')->default(0); // No of paid frequency counts
            $table->double('total_amount_paid', 14, 2)->default(0);
            $table->string('status')->default('active'); // when complete payment, this changes to completed
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
        Schema::dropIfExists('loans');
    }
}
