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

        /** Not Admin directive */
        Blade::directive(
            'isNotAdmin',
            fn() => "<?php if(!Auth::user()->isAdmin()): ?>"
        );

        Blade::directive(
            'endIsNotAdmin',
            fn() => "<?php endif; ?>"
        );
        /** end: Not Admin directive */

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

        /** Not Doctor directive */
        Blade::directive(
            'isNotDoctor',
            fn() => "<?php if(!Auth::user()->isDoctor()): ?>"
        );

        Blade::directive(
            'endIsNotDoctor',
            fn() => "<?php endif; ?>"
        );
        /** end: Not Doctor directive */

        /** Patient directive */
        Blade::directive(
            'isPatient',
            fn() => "<?php if(Auth::user()->isPatient()): ?>"
        );

        Blade::directive(
            'endIsPatient',
            fn() => "<?php endif; ?>"
        );
        /** end: Patient directive */

        /** Not Patient directive */
        Blade::directive(
            'isNotPatient',
            fn() => "<?php if(!Auth::user()->isPatient()): ?>"
        );

        Blade::directive(
            'endIsNotPatient',
            fn() => "<?php endif; ?>"
        );
        /** end: Not Patient directive */
    }
}
