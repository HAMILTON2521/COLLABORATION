<?php

namespace App\Livewire\Web;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.web')]
#[Title('Blog')]
class Blog extends Component
{
    public function render()
    {
        return view('livewire.web.blog');
    }
}
