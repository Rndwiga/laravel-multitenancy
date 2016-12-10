<?php

return [

    /*
     * The type of the multitenancy
     * ============================
     *
     * Options are:
     *
     *      subdomain       - Will look for http://{tenantslug}.your.domain
     *      directory       - Will look for http://your.domain/{tenantslug}/your/route
     *      domain          - Will look for both http://{tenantslug}.your.domain and http://{tenantdomain}
     */
    'type'          => 'subdomain',

    'domain'        => env('MULTITENANCY_DOMAIN', 'domain.com'),    // Used for both the subdomain and domain type

    /*
     * Provider driver
     * ===============
     *
     * Options are:
     *
     *      eloquent        - Use the Laravel AR models
     *      database        - Direct database calls
     */
    'provider'      => 'eloquent',

    'model'         => Ollieslab\Multitenancy\Models\Tenant::class,

    // These are only used for driver database
    'table'         => '', // Only used for driver database
    'identifiers'   => [
        'domain', 'slug'
    ]

];
