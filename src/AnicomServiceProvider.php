<?php

namespace Ajtarragona\Anicom;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Blade;
//use Illuminate\Support\Facades\Schema;

class AnicomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
  
        //vistas
        $this->loadViewsFrom(__DIR__.'/resources/views', 'anicom-client');
        
        //cargo rutas
        $this->loadRoutesFrom(__DIR__.'/routes.php');


        //publico configuracion
        $config = __DIR__.'/Config/anicom.php';
        
        $this->publishes([
            $config => config_path('anicom.php'),
        ], 'ajtarragona-anicom-config');


        $this->mergeConfigFrom($config, 'anicom');


         //publico assets
        $this->publishes([
            __DIR__.'/public' => public_path('vendor/ajtarragona'),
        ], 'ajtarragona-anicom-assets');



       
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       	//registro middleware
        $this->app['router']->aliasMiddleware('anicom-backend', \Ajtarragona\Anicom\Middlewares\AnicomBackend::class);

        //defino facades
        $this->app->bind('anicom', function(){
            return new \Ajtarragona\Anicom\Providers\AnicomProvider;
        });
        

        //helpers
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}
