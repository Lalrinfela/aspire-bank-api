<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller {

    protected $request;
    protected $repayment;
    protected $loan;

    public function __construct(Request $request, Repayment $repayment, Loan $loan) 
    {
        $this->request = $request;    
        $this->repayment = $repayment;
        $this->loan = $loan;
    }
    
    public function payment()
    {
        $this->validate($this->request, 
        [
            'loan_id' => 'required',
            'amount' => 'required',
            'payment_type' => 'required'
        ],
        [
            'loan_id.required' => 'Please provide the loan id for repayment',
            'amount' => 'Please provide the amount for installments',
            'payment_type' => 'Accepted Type: Online, In Cash, Cheque'
        ]);
        $loan = $this->loan->find($this->request->loan_id);
        if($loan->frequency_paid >= $loan->frequency) {
            return 'This loan is already repaid.';
        } else {
            $data['amount'] = $this->request->amount;
            $data['loan_id'] = $this->request->loan_id;
            $data['payment_type'] = $this->request->payment_type;
            $data['paid_on'] = date('Y-m-d');
            $data['amount_balance'] = $loan->total_amount - ($loan->total_amount_paid+$data['amount']);
            $data['frequency_balance'] = $loan->frequency - 1;
            $repayment = $this->repayment->create($data);
            if(($loan->frequency_paid+1) >= $loan->frequency) {
                $this->loan->where('id', $loan->id)->update(['frequency_paid' => $loan->frequency_paid+1, 'total_amount_paid' => $loan->total_amount_paid+$data['amount'], 'status' => 'completed']);
            } else {
                $this->loan->where('id', $loan->id)->update(['frequency_paid' => $loan->frequency_paid+1, 'total_amount_paid' => $loan->total_amount_paid+$data['amount']]);
            }
            return $repayment;
        }
    }
}