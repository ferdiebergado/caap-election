<?php

namespace App\Http\ViewComposers;

use App\Election;
use \Illuminate\View\View;

class ElectionComposer
{
    /**
     * The Election model.
     *
     * @var Election
     */
    protected $election;

    /**
     * Create a new profile composer.
     *
     * @param  Election  $election
     * @return void
     */
    public function __construct(Election $election)
    {
        // Dependencies automatically resolved by service container...
        $this->election = $election;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('elections', $this->election->latest()->get(['id', 'title as name']));
    }
}
