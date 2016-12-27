# Laravel Multitenancy #

[![Latest Stable Version](https://poser.pugx.org/ollieslab/laravel-multitenancy/v/stable.png)](https://packagist.org/packages/ollieslab/laravel-multitenancy) [![Total Downloads](https://poser.pugx.org/ollieslab/laravel-multitenancy/downloads.png)](https://packagist.org/packages/ollieslab/laravel-multitenancy) [![Latest Unstable Version](https://poser.pugx.org/ollieslab/laravel-multitenancy/v/unstable.png)](https://packagist.org/packages/ollieslab/laravel-multitenancy) [![License](https://poser.pugx.org/ollieslab/laravel-multitenancy/license.png)](https://packagist.org/packages/ollieslab/laravel-multitenancy)


- **Laravel**: 5.3
- **Author**: Ollie Read 
- **Author Homepage**: http://ollieslab.io

This package is not a replacement for Laravel's default Auth library, but instead something
that sits between your code and the library.

Think of it as a factory class for Auth. Now, instead of having a single table/model to
authenticate users against, you can now have multiple, and unlike the previous version of
this package, you have access to all functions, and can even use a different driver 
for each user type.

On top of that, you can use multiple authentication types, simultaneously, so you can be logged
in as a user, a master account and an admin, without conflicts!


## Installation ##

Firstly you want to include this package in your composer.json file.

    "require": {
    		"ollieslab/laravel-multitenancy": "dev-master"
    }
    
Now you'll want to update or install via composer.

    composer update

Next you open up app/config/app.php and add the following.

    Ollieslab\Multitenancy\ServiceProvider::class,
    
Then the facade.

    'Multitenancy' => Ollieslab\Multitenancy\Facades\Multitenancy::class,

Finally, run the following command to publish the config.

    php artisan vendor:publish --provider=Ollieslab\Multitenancy\ServiceProvider
    
## Configuration ##

The configuration is quite simple.

 - `type` The type of multitenancy, options are `domain`, `subdomain` and `directory`.
 - `domain` The domain to use for the `subdomain` type.
 - `provider` The provider, options are `database` or `eloquent`.
 - `model` The model to be used when using the `eloquent` provider.
 - `table` The table to use when using the `database` provider.
 - `identifiers` The identifiers to be used when using the `database` provider.

## Extending ##

Adding a new provider is as simple as adding a new provider to the Laravel Auth library.

The new provider must implement the interface `Ollieslab\Multitenancy\Contracts\Provider`.

In the register method of a service provider, extend the package like so:

    $this->app->make('multitenancy')->provider('custom', function ($app, $config) {
        return new CustomProvider();
    });

## Usage ##

Once you're all setup, you'll want to define the routes that should only be available to tenants.

##### Routes #####

    Multitenancy::routes(function (Router $router) {
        // Your routes here, exactly like you would inside a normal group
    });

##### Accessing Current Tenant ####

    Multitenancy::get()

##### Invalid Tenant #####

An invalid tenancy identifier, such as a domain or subdomain not registered, an `Ollieslab\Multitenancy\Exceptions\InvalidTenantException` will be thrown.

##### URL Generator #####



##### Auth #####

The auth portion of this package is coming soon.

There we go, done! Enjoy yourselves.


### License

This package inherits the licensing of its parent framework, Laravel, and as such is open-sourced 
software licensed under the [MIT license](http://opensource.org/licenses/MIT)