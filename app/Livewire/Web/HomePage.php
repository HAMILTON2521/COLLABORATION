<?php

namespace App\Livewire\Web;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.web')]
#[Title('Home')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.web.home-page');
    }
}
