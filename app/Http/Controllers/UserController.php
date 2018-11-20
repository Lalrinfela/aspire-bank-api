<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        $this->validate($request, 
            [
                'legal_name' => 'required',
                'email' => 'required|email|unique:users',
                'looking_for' => 'required'

            ],
            [
                'legal_name.required' => 'Please give us your legal name to proceed',
                'email.required' => 'Please provide your active email to proceed',
                'email.unique' => 'We seems to have this email in our database. Please contact admin to proceed. Thank you.',
                'looking_for' => 'We just need to know a little bit about your purpose of loan to proceed'
            ]
        );
        return $this->user->firstOrCreate($request->only('legal_name', 'email', 'looking_for', 'singapore_residents'));
    }
}
