<?php

namespace App\Livewire\Web;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.web')]
#[Title('About Us')]
class AboutUs extends Component
{
    public function render()
    {
        return view('livewire.web.about-us');
    }
}
