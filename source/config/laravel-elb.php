<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Excluded HTTP to HTTPS Redirection Paths
    |--------------------------------------------------------------------------
    | An array of URI paths that are NOT redirected to HTTPS.
    |
    | Adding 'unsecure' to the array will enable the view included with
    | the laravel-elb package.
    |
    */
    
    'exclude' => [ ],

    /*
    |--------------------------------------------------------------------------
    | Limit to Specific URI Path
    |--------------------------------------------------------------------------
    | Restrict to only URI paths specified by the exclude setting.  Otherwise
    | HTTPS would be excluded for paths with more depth.
    |  /unsecure vs. /unsecure/any/path
    |
    */
    
    'strict' => false,

];
