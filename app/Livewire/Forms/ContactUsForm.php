<?php

namespace App\Livewire\Forms;

use App\Models\ContactUs;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactUsForm extends Form
{
    #[Validate('required|string|max:255', as: 'first name')]
    public $first_name = '';

    #[Validate('required|string|max:255', as: 'last name')]
    public $last_name = '';

    #[Validate('required|size:10', as: 'phone number')]
    public $phone = '';

    #[Validate('nullable|email|max:60', as: 'email')]
    public $email = null;

    #[Validate('required|string', as: 'subject')]
    public $subject = '';

    #[Validate('nullable|string', as: 'message')]
    public $message = '';

    public function store()
    {
        $validData = $this->validate();

        $data =  ContactUs::create([
            'first_name' => $validData['first_name'],
            'last_name' => $validData['last_name'],
            'phone' => $validData['phone'],
            'email' => $validData['email'] ?? null,
            'subject' => $validData['subject'],
            'message' => $validData['message'],
        ]);

        if ($data) {
            session()->flash('success', 'We have received your message');
        }
    }
}
