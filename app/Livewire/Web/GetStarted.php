<?php

namespace App\Livewire\Web;

use App\Models\Setting;
use App\Models\UserVerification;
use App\Traits\GeneralHelperTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.web')]
#[Title('Create Password')]
class GetStarted extends Component
{
    use GeneralHelperTrait;
    public $user;
    public $hasSetPassword;
    public $keyIsActive = false;
    public $tokenMessage = 'Something went wrong with the link.';

    public $password, $password_confirmation;

    public function mount(string $token)
    {
        $key = Setting::where('key', 'JWT_SECRET')->first()->value;
        $user = UserVerification::with('user')->where('key', $token)->first();
        if ($user) {
            $keyStatus = $this->decodeJWTToken(token: $token, key: $key);
            if ($keyStatus->getStatusCode() === 200) {
                $this->user = $user;
                $this->hasSetPassword = $user->user->hasVerifiedEmail();
                $this->keyIsActive = true;
            } elseif ($keyStatus->getStatusCode() === 401) {
                $this->tokenMessage = 'The link has expired. Contact admin to resend a new link.';
            } elseif ($keyStatus->getStatusCode() === 400) {
                $this->tokenMessage = 'The link is invalid. Please check if you modified the link or contact with admin to resend a new link.';
            }
        }
    }

    public function rules()
    {
        return [
            'password' => ['required', 'confirmed', env('APP_ENV') === 'production' ? Password::min(8)
                ->max(20)
                ->mixedCase()
                ->symbols()
                ->numbers()
                ->uncompromised() : Password::defaults()],
            'password_confirmation' => ['required'],
        ];
    }
    public function setPassword()
    {
        $validData = $this->validate();
        $this->user->user->update([
            'password' => Hash::make($validData['password']),
            'email_verified_at' => Carbon::now(),
            'is_active' => 1
        ]);

        $this->user->update(['is_active' => 0]);

        $this->reset('password', 'password_confirmation');
        $this->hasSetPassword = true;


        return redirect()->back()->with('success', 'Password changed successfully. You can login now.');
    }
    public function render()
    {
        return view('livewire.web.get-started', [
            'user' => $this->user
        ]);
    }
}
