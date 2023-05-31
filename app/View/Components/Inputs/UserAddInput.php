<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserAddInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $key,
        public array  $item,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.user-add-input');
    }
}
