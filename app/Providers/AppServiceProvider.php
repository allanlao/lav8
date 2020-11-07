<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Date::use (CarbonImmutable::class);
    }

    public function register()
    {
        $this->registerInertia();
    }

    public function registerInertia()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share([

            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'last_name' => Auth::user()->last_name,
                        'email' => Auth::user()->email,
                        'role' => Auth::user()->role,

                    ] : null,
                ];
            },
            'flash' => function () {
                return [
                    'success' => Session::get('success'),
                    'error' => Session::get('error'),
                ];
            },
            'errors' => function () {
                return Session::get('errors')
                ? Session::get('errors')->getBag('default')->getMessages()
                : (object) [];
            },
        ]);
    }

}
