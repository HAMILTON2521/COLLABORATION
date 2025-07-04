<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Spinner extends Component
{
  public $target;

    public function __construct($target)
    {
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.spinner');
    }
}
