<?php

namespace App\Providers;

use App\Models\Calculator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CalculatorProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('calculators')) {
            $calculator = Calculator::get();
            View::share('calculatorProvider', $calculator);
        }
    }
}
