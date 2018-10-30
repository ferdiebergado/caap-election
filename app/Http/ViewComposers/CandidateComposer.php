<?php

namespace App\Http\ViewComposers;

use App\Candidate;
use \Illuminate\View\View;

class CandidateComposer
{
    /**
     * The Candidate model.
     *
     * @var Candidate
     */
    protected $candidate;

    /**
     * Create a new profile composer.
     *
     * @param  Candidate  $candidate
     * @return void
     */
    public function __construct(Candidate $candidate)
    {
        // Dependencies automatically resolved by service container...
        $this->candidate = $candidate;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $collection = $this->candidate->with(['voter' => function ($q) {
            $q->orderBy('lastname')->orderBy('firstname')->orderBy('middlename');
        }])->get();
        $candidates = $collection->map(function ($item, $key) {
            return $item->voter;
        });
        $view->with('candidates', $candidates);
    }
}
