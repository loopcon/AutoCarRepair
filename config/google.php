<?php

return [
    /*
    |----------------------------------------------------------------------------
    | Google application name
    |----------------------------------------------------------------------------
    */
    'application_name' => '',

    /*
    |----------------------------------------------------------------------------
    | Google OAuth 2.0 access
    |----------------------------------------------------------------------------
    |
    | Keys for OAuth 2.0 access, see the API console at
    | https://developers.google.com/console
    |
    */
    'client_id' => '247653983687-r6gjbc6du9074qu9f76e6er2adrvbmjn.apps.googleusercontent.com',
    'client_secret' => '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',
    'redirect_uri' => url('reviews'),
    'scopes' => ['https://www.googleapis.com/auth/plus.business.manage'],
    'access_type' => 'offline',
    'approval_prompt' => 'auto',

    /*
    |----------------------------------------------------------------------------
    | Google developer key
    |----------------------------------------------------------------------------
    |
    | Simple API access key, also from the API console. Ensure you get
    | a Server key, and not a Browser key.
    |
    */
    'developer_key' => 'AIzaSyCm_f4MOEgNY7na0hCIsz1TQIimdeVkJUU',

    /*
    |----------------------------------------------------------------------------
    | Google service account
    |----------------------------------------------------------------------------
    |
    | Set the credentials JSON's location to use assert credentials, otherwise
    | app engine or compute engine will be used.
    |
    */
    'service' =>  [
        /*
        | Enable service account auth or not.
        */
        'enabled' => false,

        /*
        | Path to service account json file
        */
        'file' => '',
    ],
];