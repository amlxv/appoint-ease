<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class AppointmentForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action,
        public array  $formData = [],
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.appointment-form');
    }
}
