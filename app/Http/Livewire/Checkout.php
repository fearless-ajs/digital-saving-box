<?php

namespace App\Http\Livewire;

use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Transaction;

class Checkout extends Component
{
    public $amount;
    public $checkout_date;
    public $wallet;

    public $checkoutForm = true;
    public $extensionForm = false;

    protected $listeners = ['extendDate' => 'extendDate', 'withdrawBalance' => 'withdrawBalance'];

    public function showCheckoutForm(){
        $this->checkoutForm = true;
        $this->extensionForm = false;
    }

    public function showExtensionForm(){
        $this->extensionForm = true;
        $this->checkoutForm = false;
    }

    public function mount(){
        $this->fetchWallet();
    }

    public function fetchWallet(){
        $wallet = Wallet::where('user_id', \Auth::user()->id)->first();
        $this->wallet = $wallet;
        $this->amount = $wallet->balance + $wallet->bonus;
    }

    public function withdraw () {
        $this->validate([
            'amount'  => 'required|numeric|min:50',
        ]);
        //Check if the withdraw date is here
        if (Carbon::now() < $this->wallet->checkout_date){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Sorry, you cannot checkout now']);
        }

        // Check if the checkout is greater than your balance
        if ($this->amount > ($this->wallet->balance + $this->wallet->bonus)){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Insufficient fund']);
        }

        //Ask if the user wants to proceed the withdrawal
        return $this->confirmWithdrawalRequest('warning', 'Are you sure to withdraw?', 'Press cancel to abort request');

    }

    public function withdrawBalance($amount){
        $reference_no = Str::random(20);
        Transaction::create([
            'user_id'      => \Auth::user()->id,
            'payment_type' => 'Withdrawal',
            'status'       => 'successful',
            'reference_no' => 'with_'.$reference_no,
            'amount'       => $this->amount
        ]);


        Wallet::where('user_id', \Auth::user()->id)->update([
           'balance' => $this->wallet->balance - $this->amount
        ]);

        $this->wallet = Wallet::where('user_id', \Auth::user()->id)->first();
        $this->amount = $this->wallet->balance;
        return $this->alert('success', 'Balance withdrawn');
    }

    public function extendCheckout(){
        $this->validate([
            'checkout_date'  => 'required|date',
        ]);
        // Check the checkout date is future
        if (Carbon::now() >= $this->checkout_date){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Select a future date']);
        }
        // Check the checkout date is future
        if ($this->wallet->checkout_date >= $this->checkout_date){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Sorry, you can only extend your checkout date']);
        }
        //Ask if the user wants to proceed the extension
       return $this->confirmExtensionRequest('warning', 'Are you sure about this?', 'Press cancel to abort request');

    }

    public function extendDate($date){
       Wallet::where('user_id', \Auth::user()->id)->update([
           'checkout_date' => $this->checkout_date
        ]);

       return $this->alert('success', 'Extension successful');
    }


    public function extensionConfirm(){
        //Notify User before delete i.e fire the event listener
        $this->confirmRequest('warning', 'Are you sure!', 'Press cancel to abort request');
    }



    public function confirmRequest($type, $title, $text="Press Ok to Continue", $id=''){
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => $type,
            'title' => $title,
            'text' => $text,
            'id'   => $id
        ]);
    }


    public function confirmExtensionRequest($type, $title, $text="Press Ok to Continue", $id=''){
        $this->dispatchBrowserEvent('swal:confirmExtension', [
            'type' => $type,
            'title' => $title,
            'text' => $text,
            'id'   => $id
        ]);
    }


    public function confirmWithdrawalRequest($type, $title, $text="Press Ok to Continue", $amount=''){
        $this->dispatchBrowserEvent('swal:confirmWithdraw', [
            'type' => $type,
            'title' => $title,
            'text' => $text,
            'id'   => $amount
        ]);
    }

    public function alert($type, $title, $text="Press ok to continue"){
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => $type,
            'title' => $title,
            'text' => $text,
        ]);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
