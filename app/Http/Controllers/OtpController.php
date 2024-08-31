<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    public function create()
    {
        return view('otp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobile_number'=>['required'],
        ]);

        $basic  = new \Vonage\Client\Credentials\Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
        $client = new \Vonage\Client($basic);
        // $basic  = new \Vonage\Client\Credentials\Basic("e048960f", "lCe5av8ecLW7tDW1");
        // $client = new \Vonage\Client($basic);
        $from = env('VONAGE_SMS_FROM');
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("01062800069", $from , 'A text message sent using the Nexmo SMS API')
        );

            // Session::put('otp' , $response->getRequestId());
        
        // $message = $response->current();
        
        // if ($message->getStatus() == 0) {
        //     echo "The message was sent successfully\n";
        // } else {
        //     echo "The message failed with status: " . $message->getStatus() . "\n";
        // }
        return redirect()->route('otp.verify');
    }

    public function verifyForm()
    {
        return view('otp.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);


        return redirect()->route(RouteServiceProvider::HOME);
    }
}
