<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Excluded HTTP to HTTP Redirection Paths
    |--------------------------------------------------------------------------
    | An array of URI paths that are NOT redirected to HTTPS.
    |
    */
    
    'exclude' => [ 'unsecure', ],

    /*
    |--------------------------------------------------------------------------
    | Limit to Root of URI Path
    |--------------------------------------------------------------------------
    | Restrict to only URI paths specified by the exclude setting.  Otherwise
    | HTTP would be excluded for paths with more depth.
    |  /unsecure vs. /unsecure/alpha/bravo/charlie
    |
    */
    
    'root_only' => false,

];
