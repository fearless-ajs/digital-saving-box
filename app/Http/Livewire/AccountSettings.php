<?php

namespace App\Http\Livewire;

use App\Models\AccountSetting;
use Livewire\Component;

class AccountSettings extends Component
{
    public $name;
    public $number;
    public $type;
    public $bank;


    public function mount(){
        $this->fetchAccount();
    }

    public function fetchAccount(){
        $account        = AccountSetting::where('user_id', \Auth::user()->id)->first();
        $this->name     = $account->account_name;
        $this->number   = $account->account_number;
        $this->type     = $account->account_type;
        $this->bank     = $account->bank_code;
    }

    public function updated($field){
        $this->validateOnly($field, [
            'name'      => 'required|string|max:255',
            'number'    => 'required|numeric',
            'type'      => 'required|string|in:Savings,Current',
            'bank'      => 'required|numeric|max:1000',
        ]);
    }

    public function updateAccount (){
        $this->validate([
            'name'      => 'required|string|max:255',
            'number'    => 'required|numeric',
            'type'      => 'required|string|in:Savings,Current',
            'bank'      => 'required|numeric|max:1000',
        ]);

        AccountSetting::where('user_id', \Auth::user()->id)->update([
            'account_name'      => $this->name,
            'account_number'    => $this->number,
            'account_type'      => $this->type,
            'bank_code'         => $this->bank,
        ]);
        $this->emit('alert', ['type' => 'success', 'message' => 'Account update successful']);
    }


    public function render()
    {
        return view('livewire.account-settings');
    }
}
