<?php

namespace Plans\Http\ViewComposers;

use Illuminate\View\View;
use Plans\Models\Floor;

class FloorsComposer
{
    /**
     * The service code repository implementation.
     *
     * @var FloorRepository
     */
    protected $floors;

    /**
     * Create a new profile composer.
     *
     * @param  Floor  $floors
     * @return void
     */
    public function __construct(Floor  $floors)
    {
        // Dependencies automatically resolved by service container...
        $this->floors = $floors;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('floors', $this->floors->listFloors());
    }
}