<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App Push Notification Messages & SMS's
    |--------------------------------------------------------------------------
    |
    | These are the api specific codes. They will help to properly differentiate
    | between various responses and errors especially in  case of a single endpoint
    | with multiple 400 errors for example
    |
    */

    'api' => [
        'success' => [
            'code' => '20000',
            'status' => 'ok',
            'successful' => true,
            'message' => 'Request was successful.'
        ],
        'created' => [
            'code' => '20100',
            'status' => 'ok',
            'successful' => true,
            'message' => 'Resource was successfully created.'
        ],
        'created' => [
            'code' => '20400',
            'status' => 'ok',
            'successful' => true,
            'message' => 'Resource was successfully created.'
        ],
        'bad_request' => [
            'code' => '002',
            'status' => 'bad_request',
            'successful' => false,
            'message' => 'Bad Request.'
        ],
        'invalid_token' => [
            'code' => '012',
            'status' => 'invalid_token',
            'successful' => false,
            'message' => 'An invalid token was supplied.'
        ],
        'expired_token' => [
            'code' => '022',
            'status' => 'invalid_token',
            'successful' => false,
            'message' => 'An expired token was supplied.'
        ],
        'already_verified' => [
            'code' => '032',
            'status' => 'invalid_token',
            'successful' => false,
            'message' => 'User has already been verified.'
        ],
        'invalid_credentials' => [
            'code' => '042',
            'status' => 'invalid_credentials',
            'successful' => false,
            'message' => 'Invalid username or password.'
        ],
        'unverified_account' => [
            'code' => '052',
            'status' => 'unverified_account',
            'successful' => false,
            'message' => "User's email has not been verified"
        ],
        'invalid_data' => [
            'code' => '062',
            'status' => 'invalid_data',
            'successful' => false,
            'message' => "Invalid data sent"
        ],
        'inactive_user' => [
            'code' => '072',
            'status' => 'inactive_user',
            'successful' => false,
            'message' => "User account is inactive"
        ],
        'inactive_counsellor' => [
            'code' => '082',
            'status' => 'inactive_counsellor',
            'successful' => false,
            'message' => "Counsellor account is inactive"
        ],
        'forbidden' => [
            'code' => '003',
            'status' => 'forbidden',
            'successful' => false,
            'message' => 'Forbidden Request.'
        ],
        'unauthorised' => [
            'code' => '004',
            'status' => 'unauthorised',
            'successful' => false,
            'message' => 'Unauthorised Request.'
        ],
        'not_found' => [
            'code' => '005',
            'status' => 'not_found',
            'successful' => false,
            'message' => 'Resource was not found.'
        ],
        'duplicate' => [
            'code' => '006',
            'status' => 'duplicate_entry',
            'successful' => false,
            'message' => 'Resource already exist.'
        ],
        'multiple_pending' => [
            'code' => '016',
            'status' => 'multiple_pending',
            'successful' => false,
            'message' => 'Counsellor already has pending bookings within the selected time frame. You can go ahead and book however we cant guarantee the counsellor will be available at this time'
        ],
        'already_booked' => [
            'code' => '026',
            'status' => 'already_booked',
            'successful' => false,
            'message' => 'Counsellor already has a booking within the selected time frame.'
        ],
        'server_error' => [
            'code' => '007',
            'status' => 'server_error',
            'successful' => false,
            'message' => 'An unexpected error occured.'
        ],
    ],
    'web' => [

    ],
    'pn' => [

    ]
];
