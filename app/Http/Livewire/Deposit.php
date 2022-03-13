<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Session;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use Livewire\Component;

class Deposit extends Component
{

    public $amount;

    public function updated($field){
        $this->validateOnly($field, [
          'amount' => 'required|min:1'
        ]);
    }

    public function deposit(){
        $this->validate([
            'amount' => 'required|min:1'
        ]);

        if ($this->amount < 50){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Minimum deposit is #50']);
        }

//        dd(Session::get('userInfo'));
        // Redirect to donation payment type page
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' =>$this->amount,
            'email' => \Auth::user()->email,
            'tx_ref' => $reference,
            'currency' => 'NGN',
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => \Auth::user()->email,
                "phone_number" => 000000000000,
                "name" => \Auth::user()->name
            ],

            "customizations" => [
                "title" => 'Saving box contribution',
                "description" => "SavingContribution",
                "logo"=>"https://png.pngtree.com/png-vector/20190227/ourmid/pngtree-vector-bank-icon-png-image_708538.jpg"
            ]
        ];

        $payment = Flutterwave::initializePayment($data);
        if ($payment['status'] !== 'success') {
            return redirect(route('deposit'))->with('error',"Unable to complete transaction");
        }

        Transaction::create([
            'user_id'      => \Auth::user()->id,
            'payment_type' => 'Deposit',
            'amount'       => $this->amount,
            'reference_no' => $reference,
            'status'       => 'pending'
        ]);

       return redirect($payment['data']['link']);

    }

    public function render()
    {
        return view('livewire.deposit');
    }
}
