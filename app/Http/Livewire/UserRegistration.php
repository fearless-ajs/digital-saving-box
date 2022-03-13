<?php

namespace App\Http\Livewire;

use App\Models\AccountSetting;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Livewire\Component;

class UserRegistration extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $checkout_date;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|unique:users,email',
            'checkout_date'  => 'required|date',
            'password'       => 'required|string|confirmed'
        ]);
    }

    public function register() {
        $this->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|unique:users,email',
            'checkout_date'  => 'required|date',
            'password'       => 'required|string|confir med'
        ]);

        // Check the checkout date is future
        if (Carbon::now() >= $this->checkout_date){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Select a future date']);
        }

        $user = User::create([
            'name'          => $this->name,
            'email'         => $this->email,
            'password'      => $this->password,
        ]);

        // Create user wallet
        Wallet::create([
            'user_id'       => $user->id,
            'balance'       => 0.00,
            'bonus'         => 0.00,
            'checkout_date' => $this->checkout_date
        ]);

        AccountSetting::create([
            'user_id'       => $user->id,
            'account_name'  => $this->name,
        ]);

        $this->name                  = '';
        $this->email                 = '';
        $this->password              = '';
        $this->password_confirmation = '';
        $this->checkout_date         = '';
        $this->emit('alert', ['type' => 'success', 'message' => 'Registration successful']);
        return redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.user-registration');
    }
}
