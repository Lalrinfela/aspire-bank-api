<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'duration', 'frequency', 'interest_rate', 'interest_amount', 'arrangement_fee', 'total_amount', 'opening', 'frequency_paid', 'total_amount_paid', 'status' 
    ];

}
