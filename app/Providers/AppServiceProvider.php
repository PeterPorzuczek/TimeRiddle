<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::withoutDoubleEncoding();

        Validator::extend('valid_json', function ($attributes, $value, $parameters, $validation) {
            $json_string = $value;

            if(!is_string($json_string)) {
                return false;
            }
            json_decode($json_string);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }
            return true;
        });
    }
}
