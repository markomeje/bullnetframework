<?php 

declare(strict_types=1);
namespace Bullnet\Core;


abstract class Providers 
{

    /**
     * @var object
     */
    public $app;
    
    /**
     * @return void
     */
    final public function __construct(App &$app)
    {
        $this->app = $app;
    }

    /**
     * Register a service provider
     * @return void
     */
    abstract public function register();

    /**
     * Boot a service provider
     * @return void
     */
    abstract public function boot();

    /**
     * @param app
     * @param $providers
     * @return void
     */
    final public static function setup(App &$app, array $providers = [])
    {
        $providers = array_map(fn($provider) => new $provider($app), $providers);
        array_walk($providers, fn(Providers $provider) => $provider->register());
        array_walk($providers, fn(Providers $provider) => $provider->boot());
    }

}
