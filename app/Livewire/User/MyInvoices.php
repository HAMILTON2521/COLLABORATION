<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('My Invoices')]
class MyInvoices extends Component
{
    public function render()
    {
        return view('livewire.user.my-invoices');
    }
}
