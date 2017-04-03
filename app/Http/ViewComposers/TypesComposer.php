<?php

namespace Plans\Http\ViewComposers;

use Illuminate\View\View;
use Plans\Models\Type;

class TypesComposer
{
    /**
     * The service code repository implementation.
     *
     * @var TypeRepository
     */
    protected $types;

    /**
     * Create a new profile composer.
     *
     * @param  Type  $types
     * @return void
     */
    public function __construct(Type  $types)
    {
        // Dependencies automatically resolved by service container...
        $this->types = $types;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('types', $this->types->listTypes());
    }
}