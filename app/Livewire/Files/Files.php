<?php

namespace App\Livewire\Files;

use App\Traits\HttpHelper;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Get Archive List')]
class Files extends Component
{
    use HttpHelper;

    public array $files = [];

    public function mount(): void
    {
        $this->files();
    }

    public function files(): void
    {
        try {
            $this->files = $this->getFiles();
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
    }

    public function placeholder(): string
    {
        return <<<'HTML'
                    <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
               HTML;

    }

    public function render()
    {
        return view('livewire.files.files');
    }
}
