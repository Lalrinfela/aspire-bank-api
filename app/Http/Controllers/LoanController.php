<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller {

    protected $request;
    protected $loan;

    public function __construct(Request $request, Loan $loan) 
    {
        $this->request = $request;
        $this->loan = $loan;
    }

    public function apply()
    {
        $this->request->request->add(['status' => 'active']);
        $this->validate($this->request, [
            'user_id' => 'required|unique_with:loans, user_id, status', //Only one active loan is allowed
            'amount' => 'required|numeric|min:1000',
            'duration' => 'required|numeric|min:3'
        ],
        [
            'user_id' => 'Hmm! We need a user id to process the loan.',
            'amount.min' => 'Loan amount must be atleat S$1000',
            'duration.min' => 'Loan duration must be atleat 3 Months',
            'user_id.unique_with' => 'You seems to have an active loan. Please clear your active loan to avail another loan.'
        ]);
        $data['user_id'] = $this->request->user_id;
        $data['amount'] = $this->request->amount;
        $data['duration'] = $this->request->duration;
        $data['frequency'] = ceil($this->request->duration); // Monthly i.e The no. of months. In case of decimal, it will be no. of months + 1;
        $data['interest_rate'] = 1.5; // 1.5% 
        $data['interest_amount'] = (0.015*$this->request->amount) * (ceil($this->request->duration));// 1.5% of Amount
        $data['arrangement_fee'] = 1000; //S$1000 just for example
        $data['total_amount'] = $data['amount'] + $data['interest_amount'] + $data['arrangement_fee'];
        $data['opening'] = date('Y-m-d');
        return $this->loan->create($data);
    }

}