<?php

namespace App\Http\Controllers;

class ConfigurationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function clearRoute()
    {
        \Artisan::call('route:clear');
    }
}
