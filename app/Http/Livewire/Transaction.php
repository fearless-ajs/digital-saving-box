<?php

namespace App\Http\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction as AllTransactions;

class Transaction extends Component
{
    use WithPagination;
    public $wallet;

    public function mount(){
        $this->wallet = Wallet::where('user_id', \Auth::user()->id)->first();
    }

    public function render()
    {
        return view('livewire.transaction', [
            'transactions' => AllTransactions::orderBy('created_at', 'DESC')->where('user_id', \Auth::user()->id)->paginate(50)
        ]);
    }
}
