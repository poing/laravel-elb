<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Excluded HTTP to HTTPS Redirection Paths
    |--------------------------------------------------------------------------
    | An array of URI paths that are NOT redirected to HTTPS.
    |
    | Removing 'unsecure' from the array will disable the view included with
    | the laravel-elb package.
    |
    */
    
    'exclude' => [ 'unsecure', ],

    /*
    |--------------------------------------------------------------------------
    | Limit to Root of URI Path
    |--------------------------------------------------------------------------
    | Restrict to only URI paths specified by the exclude setting.  Otherwise
    | HTTPS would be excluded for paths with more depth.
    |  /unsecure vs. /unsecure/alpha/bravo/charlie
    |
    */
    
    'root_only' => true,

];
