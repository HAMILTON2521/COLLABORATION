<?php

namespace App\Livewire\Web;

use App\Livewire\Forms\ContactUsForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.web')]
#[Title('Contact')]
class ContactUs extends Component
{
    public ContactUsForm $form;

    public function save()
    {
        $this->form->store();

        $this->form->reset();
        session()->flash('success', 'We have received your message');
    }
    public function render()
    {
        return view('livewire.web.contact-us');
    }
}
