<?php

namespace App\Livewire\Equipment;

use App\Models\ValveControl as ModelsValveControl;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Valve Control')]
class ValveControl extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $perPage = 10;

    // Reset pagination when search query changes
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed()]
    public function valveControls()
    {
        return ModelsValveControl::latest()->search($this->search)->paginate($this->perPage);
    }

    #[Computed()]
    public function pages()
    {
        return [10, 25, 50, 100];
    }

    public function delete(ModelsValveControl $valveControl): void
    {
        $valveControl->delete();
        flash()->success("Valve control command deleted successfully");
    }

    public function render()
    {
        return view('livewire.equipment.valve-control');
    }
}
