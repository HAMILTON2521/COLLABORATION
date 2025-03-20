<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserAccountsTable extends Component
{
    /**
     * Create a new component instance.
     */
    public $accounts;
    public function __construct($accounts = [])
    {
        $this->accounts = $accounts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-accounts-table');
    }
}
