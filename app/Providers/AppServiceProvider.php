<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Response JSON
        Response::macro('responseJson', function ($status, $message, $code) {
            return Response::json([
                'status' => $status,
                'message' => $message,
                'code' => $code
            ], $code);
        });
    }
}
