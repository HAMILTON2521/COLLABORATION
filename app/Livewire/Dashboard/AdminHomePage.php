<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class AdminHomePage extends Component
{
    public function render()
    {
        return view('livewire.dashboard.admin-home-page');
    }
}
