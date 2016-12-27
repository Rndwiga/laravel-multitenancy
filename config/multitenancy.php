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

    /*
     * Everything below here is only used for the database provider
     * ============================================================
     */

    // The database table to use
    'table'         => 'tenants', 

    // The database columns to use for identifiers. This should be 2 values for the domain type, and 1 for the others
    'identifiers'   => [
        'domain', 'slug'
    ],

    // The database column that represents the foreign key for the tenant
    'foreign_key'   => 'tenant_id'

];
