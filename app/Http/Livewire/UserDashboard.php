<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\Wallet;
use Livewire\Component;

class UserDashboard extends Component
{
    public $wallet;
    public $lastDeposit;
    public $lastWithdrawal;


    public function mount(){
        $this->fetchWallet();
        $this->computeTransactions();
    }

    public function fetchWallet(){
        $this->wallet = Wallet::where('user_id', \Auth::user()->id)->first();
    }

    public function computeTransactions(){
        $lastDepositTransaction    = Transaction::orderBy('created_at', 'DESC')->where('user_id', \Auth::user()->id)->where('payment_type', 'Deposit')->first();
        $lastWithdrawalTransaction = Transaction::orderBy('created_at', 'DESC')->where('user_id', \Auth::user()->id)->where('payment_type', 'Withdrawal')->first();
        if ($lastDepositTransaction){
            $this->lastDeposit = $lastDepositTransaction->amount;
        }else{
            $this->lastDeposit = 0.00;
        }

        if ($lastWithdrawalTransaction){
            $this->lastWithdrawal = $lastWithdrawalTransaction->amount;
        }else{
            $this->lastWithdrawal = 0.00;
        }
    }

    public function render()
    {
        return view('livewire.user-dashboard');
    }
}
