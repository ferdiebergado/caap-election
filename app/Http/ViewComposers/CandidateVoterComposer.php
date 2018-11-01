<?php

namespace App\Http\ViewComposers;

use App\Voter;
use \Illuminate\View\View;

class CandidateVoterComposer
{
    /**
     * The Voter model.
     *
     * @var Voter
     */
    protected $voter;

    /**
     * Create a new profile composer.
     *
     * @param  Voter  $voter
     * @return void
     */
    public function __construct(Voter $voter)
    {
        // Dependencies automatically resolved by service container...
        $this->voter = $voter;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('voters', $this->voter->where('candidate', false)->orderBy('lastname')->orderBy('firstname')->get());
    }
}
