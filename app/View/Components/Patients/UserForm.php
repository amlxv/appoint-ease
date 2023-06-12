<?php

namespace App\View\Components\Patients;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class UserForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action,
        public ?Model $formData = null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.patients.user-form');
    }
}
