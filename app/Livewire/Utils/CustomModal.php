<?php

namespace App\Livewire\Utils;

use Livewire\Attributes\On;
use Livewire\Component;

class CustomModal extends Component
{
    public $modalTitle;
    public $modalBody;
    public $modalView;
    public $modalVisible = false;
    public $size;
    public $showFooter = true;

    #[On('showModal')]
    public function showCustomModal($payload): void
    {
        $this->modalSize($payload['size'] ?? 'medium');
        $this->modalTitle = $payload['title'] ?? '';
        $this->modalBody = $payload['body'] ?? null;
        $this->modalView = $payload['view'] ?? null;
        $this->modalVisible = true;
        $this->showFooter = $payload['showFooter'] ?? true;

        $this->dispatch('show-modal-data');
    }

    public function modalSize($size)
    {
        $modalSizes = [
            'large' => 'modal-lg',
            'medium' => 'modal-md',
            'small' => 'modal-sm',
        ];

        $this->size = $modalSizes[$size];
    }

    #[On('hideModal')]
    public function hideModal(): void
    {
        $this->modalVisible = false;
        $this->modalBody = null;
        $this->modalView = null;
        $this->dispatch('hide-modal-data');
    }

    public function render()
    {
        return view('livewire.utils.custom-modal');
    }
}
