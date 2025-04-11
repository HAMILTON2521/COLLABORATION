<?php

namespace App\Livewire\Utils;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class CustomModal extends Component
{
    public $modalTitle;
    public $modalBody;
    public $modalVisible = false;
    public $size;

    public function modalSize($size)
    {
        $modalSizes = [
            'large' => 'modal-lg',
            'medium' => 'modal-md',
            'small' => 'modal-sm',
        ];

        $this->size = $modalSizes[$size];
    }


    #[On('showModal')]
    public function showCustomModal($payload)
    {
        $this->modalSize($payload['size'] ?? 'medium');
        $this->modalTitle = $payload['title'] ?? '';
        $this->modalBody = $payload['body'] ?? 'Loading...';
        $this->modalVisible = true;

        $this->dispatch('show-modal-data');
    }

    public function render()
    {
        return view('livewire.utils.custom-modal');
    }
}
