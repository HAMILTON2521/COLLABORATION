<?php

namespace App\Livewire\Users;

use App\Models\Customer;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Assign Account')]
class AssignAccount extends Component
{
    public $selectedAccounts = [];
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    #[Computed()]
    public function customers()
    {
        return $this->user->unassignedAccounts();
    }
    public function setSelectedAccount($customerId, $isChecked)
    {
        if ($isChecked) {
            if (!in_array($customerId, $this->selectedAccounts)) {
                $this->selectedAccounts[] = $customerId;
            }
        } else {
            $this->selectedAccounts = array_filter($this->selectedAccounts, fn($id) => $id != $customerId);
        }
    }
    public function selectAll()
    {
        if (count($this->selectedAccounts) === $this->customers()->count()) {
            $this->selectedAccounts = [];
        } else {
            $this->selectedAccounts = [];
            $this->selectedAccounts = $this->customers()->pluck('id')->toArray();
        }
    }
    public function assignSelected()
    {
        if (empty($this->selectedAccounts)) {
            $this->dispatch('showToast', message: 'Please select at least one account.', status: 'Failed');
            return;
        }

        foreach ($this->selectedAccounts as $customerId) {
            UserAccount::create([
                'user_id' => $this->user->id,
                'customer_id' => $customerId
            ]);
        }

        $this->selectedAccounts = [];

        session()->flash('success', 'Account assigned successfully');
        $this->redirectRoute('more.users.accounts', $this->user->id);
    }
    public function render()
    {
        return view('livewire.users.assign-account');
    }
}
