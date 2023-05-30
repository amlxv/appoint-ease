<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /** Admin directive */

        Blade::directive(
            'isAdmin',
            fn() => "<?php if(Auth::user()->isAdmin()): ?>"
        );

        Blade::directive(
            'endIsAdmin',
            fn() => "<?php endif; ?>"
        );

        /** end: Admin directive */

        /** Doctor directive */

        Blade::directive(
            'isDoctor',
            fn() => "<?php if(Auth::user()->isDoctor()): ?>"
        );

        Blade::directive(
            'endIsDoctor',
            fn() => "<?php endif; ?>"
        );

        /** end: Doctor directive */

        /** Patient directive */

        Blade::directive(
            'isPatient',
            fn() => "<?php if(Auth::user()->isDoctor()): ?>"
        );

        Blade::directive(
            'endIsPatient',
            fn() => "<?php endif; ?>"
        );

        /** end: Patient directive */
    }
}
