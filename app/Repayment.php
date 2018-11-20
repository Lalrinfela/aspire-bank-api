<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loan_id', 'amount', 'paid_on', 'payment_type', 'amount_balance', 'frequency_balance'
    ];

}
