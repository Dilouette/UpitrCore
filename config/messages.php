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
            'status' => 'created',
            'successful' => true,
            'message' => 'Resource was successfully created.'
        ],
        'accepted' => [
            'code' => '20200',
            'status' => 'accepted',
            'successful' => true,
            'message' => 'Resource has been received but not yet acted upon.'
        ],
        'bad_request' => [
            'code' => '40000',
            'status' => 'bad_request',
            'successful' => false,
            'message' => 'Bad Request.'
        ],
        'unauthorised' => [
            'code' => '40100',
            'status' => 'unauthorised',
            'successful' => false,
            'message' => 'Unauthorised Request.'
        ],
        'invalid_credentials' => [
            'code' => '40101',
            'status' => 'invalid_credentials',
            'successful' => false,
            'message' => 'Your username or password is incorrect'
        ],
        'forbidden' => [
            'code' => '40300',
            'status' => 'forbidden',
            'successful' => false,
            'message' => 'Forbidden Request.'
        ],
        'not_found' => [
            'code' => '40400',
            'status' => 'not_found',
            'successful' => false,
            'message' => 'Resource was not found.'
        ],
        'duplicate' => [
            'code' => '40900',
            'status' => 'duplicate_entry',
            'successful' => false,
            'message' => 'Resource already exist.'
        ],
        'unprocessable_entity' => [
            'code' => '42200',
            'status' => 'unprocessable_entity',
            'successful' => false,
            'message' => 'An invalid data was supplied.'
        ],
        'server_error' => [
            'code' => '50000',
            'status' => 'server_error',
            'successful' => false,
            'message' => 'An unexpected server exception occured.'
        ],
    ],
    'web' => [

    ],
    'pn' => [

    ]
];
