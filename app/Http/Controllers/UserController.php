<?php

namespace App\Http\Controllers;

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
                'email' => 'required|email',
                'role' => 'required'
            ],
            [
                'legal_name.required' => 'Please give us your legal name to proceed',
                'email.required' => 'Please provide your active email to proceed',
                'role' => 'We just need to know a little bit about your role to proceed'
            ]
        );
        return $this->user->firstOrCreate($request->only('legal_name', 'email', 'role'));
    }
}
