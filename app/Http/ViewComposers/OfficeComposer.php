<?php

namespace App\Http\ViewComposers;

use App\Office;
use \Illuminate\View\View;

class OfficeComposer
{
    /**
     * The Office model.
     *
     * @var Office
     */
    protected $office;

    /**
     * Create a new profile composer.
     *
     * @param  Office  $office
     * @return void
     */
    public function __construct(Office $office)
    {
        // Dependencies automatically resolved by service container...
        $this->office = $office;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('offices', $this->office->orderBy('name')->get(['id', 'name']));
    }
}
