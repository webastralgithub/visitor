<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Laravel\Cashier\Cashier;
use App\Models\Cashier\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Cashier::ignoreMigrations(User::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('at_least_one_filled', function ($attribute, $value, $parameters, $validator) {
            foreach ($value as $field) {
                if (!empty($field)) {
                    return true; 
                }
            }
            return false;
        });

        Validator::extend('all_valid_url', function ($attribute, $value, $parameters, $validator) {
            foreach ($value as $field) {
                if (!empty($field) && filter_var($field, FILTER_VALIDATE_URL) === false) {
                    return false;
                }
            }
            return true;
        });

        Paginator::useBootstrap();
    }
}
