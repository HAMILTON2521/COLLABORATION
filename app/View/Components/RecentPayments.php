<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecentPayments extends Component
{
    /**
     * Create a new component instance.
     */
    public $payments;
    public function __construct($payments = [])
    {
        $this->payments = $payments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recent-payments');
    }
}
