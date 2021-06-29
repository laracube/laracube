<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laracube App Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to display the name of the application within the UI
    | or in other locations. Of course, you're free to change the value.
    |
    */

    'name' => env('LARACUBE_APP_NAME', env('APP_NAME')),

    /*
    |--------------------------------------------------------------------------
    | Laracube Domain Name
    |--------------------------------------------------------------------------
    |
    | This value is the "domain name" associated with your application. This
    | can be used to prevent Laracube's internal routes from being registered
    | on subdomains which do not need access to your admin application.
    |
    */

    'domain' => env('LARACUBE_DOMAIN_NAME', null),

    /*
    |--------------------------------------------------------------------------
    | Laracube Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Laracube will be accessible from. Feel free to
    | change this path to anything you like. Note that this URI will not
    | affect Laracube's internal API routes which aren't exposed to users.
    |
    */

    'path' => env('LARACUBE_PATH', '/laracube'),

    /*
    |--------------------------------------------------------------------------
    | Laracube Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Laracube route, giving you the
    | chance to add your own middleware to this stack or override any of
    | the existing middleware. Or, you can just stick with this stack.
    |
    */

    'middleware' => [
        'web',
    ],
];
