<?php

namespace App\Http\Controllers;

use App\Models\TransferUser;
use Illuminate\Http\Request;
use  App\Models\User001;

use Illuminate\Support\Facades\Validator;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class RaveController extends Controller
{
    public function initialize(Request $request)
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();


        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' =>$request->amount,
            'email' => $request->input('email'),
            'tx_ref' => $reference,
            'currency' => $request->currency,
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => $request->input('email'),
                "phone_number" => $request->input('phone'),
                "name" => $request->input('firstname'),
            ],

            "customizations" => [
                "title" => 'NTYABA Donation',
                "description" => "LoveworldSponsor",
                       "logo"=>"https://nowthatyouarebornagain.org/wp-content/uploads/2021/03/NTYABA-LOGO-small.png"

            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong

            return redirect("/")->with('status',"Unable to complete transaction");
        }
        $datas = $request->input();
        $new= $request->currency;

            $table = new User001;
            $table->email = $datas['email'];
            $table->firstname = $datas['firstname'];
            $table->phone = $datas['phone'];
            $table->lastname= $datas['lastname'];
            $table->amount= $datas['amount'];
            $table->currency=  $new;
            $table->reference_no= $reference;





            $table->save();
        return redirect($payment['data']['link']);
    }

    public function saveTransferInfo(Request $request)
    {
//        $validator = Validator::make($request->all(),
//            [
//                'name' => 'required|string|max:255',
//                'amount' => 'required|numeric|max:255',
//                'email' => 'required|string|email|max:255|unique:users',
//            ]);
//
//        if ($validator->fails()){
//            return redirect("/bank-transfer")->with('status',"Errors in your inputs");
//        }

        $transferUser = TransferUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $request->amount
        ]);
        if (!$transferUser){
            return redirect("/bank-transfer")->withErrors(['error' => 'Transaction Details Failed']);
        }
        return redirect("/bank-transfer")->with('success',"Transaction Details Received");
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {

        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {




        $transactionID = Flutterwave::getTransactionIDFromCallback();
        $data = Flutterwave::verifyTransaction($transactionID);
        $dat1=request()->customer;


     User001::where('reference_no', request()->tx_ref)->update(['transaction_id'=> $transactionID,'status'=>request()->status,]);
            return redirect("/")->with('success',"Payment Successful");
        }
        elseif ($status ==  'cancelled'){
            //Put desired action/code after transaction has been cancelled here
           return redirect("/")->with('status',"Transaction Cancelled");
        }
        else{
            //Put desired action/code after transaction has failed here
            return redirect("/")->with('status',"Error");
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
}
