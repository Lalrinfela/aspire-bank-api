#ASPIRE DEMO API for LOANS create using Laravel LUMEN Micro-services BY C. LALRINFELA

#INSTALLATION
1. composer install
2. rename .env.example to .env
3. visit /key routes and copy the 32 characters string to .env


#CREATE NEW USER
1. POST: /register with params as follows
    [
        'legal_name' => 'C. Lalrinfela',
        'email' =>  'rinfelc@gmail.com',
        'looking_for' => 'personal loan',
        'singapore_residents' => 0
    ]

2. Copy the return id of the new user created for loan application


#LOAN APPLICATION
1. POST: /apply-loan with params as follows
    [
        'user_id' => 1 //The user id returned from register
        'amount' => 10000
        'duration' => 12 // 12 Months
    ]

Note: By default, all loans have status active, unless the current loan of the user is marked 'completed', the same user cannot avail another loan. This is prevent from validation.


# LOAN REPAYMENT
1. POST: /repay-loan with params as follows
    [
        'loan_id' => 1 //The loan id return from apply-loan
        'amount' => 1200
        'payment_type' => 'In Cash' // In Cash, Cheque, Online (default)
    ]
Note: The system should block for repayment of loan that is already completed.