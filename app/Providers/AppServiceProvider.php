<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

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
        Response::macro('success', function ($message, $status_code, $data = null) {
            return response()->json([
                'message' => $message,
                'data' => $data
            ], $status_code);
        });

        Response::macro('error', function ($message, $status_code, $data = null) {
            return response()->json([
                'message' => $message,
                'errors' => $data
            ], $status_code);
        });
    }
}
