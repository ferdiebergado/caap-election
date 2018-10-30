<?php

namespace App\Http\ViewComposers;

use App\Position;
use \Illuminate\View\View;

class PositionComposer
{
    /**
     * The Position model.
     *
     * @var Position
     */
    protected $position;

    /**
     * Create a new profile composer.
     *
     * @param  Position  $position
     * @return void
     */
    public function __construct(Position $position)
    {
        // Dependencies automatically resolved by service container...
        $this->position = $position;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('positions', $this->position->orderBy('name')->get(['id', 'name']));
    }
}
