<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'voter.partial',
            'App\Http\ViewComposers\OfficeComposer'
        );
        View::composer(
            'candidate.partial',
            'App\Http\ViewComposers\ElectionComposer'
        );
        View::composer(
            'candidate.partial',
            'App\Http\ViewComposers\VoterComposer'
        );
        View::composer(
            'candidate.partial',
            'App\Http\ViewComposers\PositionComposer'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
