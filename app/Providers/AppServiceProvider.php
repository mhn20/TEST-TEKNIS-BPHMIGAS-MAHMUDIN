<?php

namespace App\Providers;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(request()->getHost() == 'localhost'){
            \URL::forceScheme('http');
        }else{
            \URL::forceScheme('https');
        }
        if (!Type::hasType('double')) {
            Type::addType('double', \Doctrine\DBAL\Types\FloatType::class);
        }
    }
}
