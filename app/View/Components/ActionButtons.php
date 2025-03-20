<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButtons extends Component
{
    /**
     * Create a new component instance.
     */
    public $editUrl;
    public $viewUrl;
    public $removeUrl;
    public $deleteItem;
    public $confirmationMessage;
    public function __construct(
        $editUrl = null,
        $viewUrl = null,
        $removeUrl = null,
        $deleteItem = null,
        $confirmationMessage = null
    ) {
        $this->editUrl = $editUrl;
        $this->removeUrl = $removeUrl;
        $this->deleteItem = $deleteItem;
        $this->viewUrl = $viewUrl;
        $this->confirmationMessage = $confirmationMessage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-buttons');
    }
}
