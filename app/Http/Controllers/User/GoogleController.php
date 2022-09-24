<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Models\Credit;
use Illuminate\Support\Str;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use App\Models\CreditHistory;
use App\Models\CSVExportSettings;
use App\Models\PhoneListUserModel;
use App\Models\PhoneListUserVerify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class GoogleController extends Controller
{
    protected $newUser;
    protected $exportHistory;
    protected $purchasePlan;
    CONST DRIVER_TYPE = 'google';
    public function handleGoogleRedirect()
    {
        return Socialite::driver(static::DRIVER_TYPE)->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver(static::DRIVER_TYPE)->user();

            $userExisted = PhoneListUserModel::where('email', $user->email)->first();

            if( $userExisted ) {

                $saveUser = PhoneListUserModel::where('email', $user->email)->first();

            }else {
                $splitName = explode(' ', $user->getName(), 2);
                $firstname = $splitName[0];
                $lastname = !empty($splitName[1]) ? $splitName[1] : '';
                return view('user.userGoogleRegister', ['newUserData'=>$user, 'lastname' => $lastname, 'firstname' => $firstname]);
            }
            Auth::loginUsingId($saveUser->id);
            $this->creditHistory = CreditHistory::where('userId',Auth::user()->id)->get();
            $this->purchasePlan = PurchasePlan::where('userId',Auth::user()->id)->get();
            $i=0;
            $dataPurchase = [];
            foreach ($this->creditHistory as $history)
            {
                $dataPurchase [$i] = $history->dataPurchase;
                $i++;
            }
            $j=0;
            $creditPurchase = [];
            foreach ($this->purchasePlan as $plan)
            {
                $creditPurchase [$j] = $plan->credit;
                $j++;
            }
            return redirect('search');
            //return view('userDashboard.userDashboard',['userHistory'=> $this->creditHistory])->with('data',json_encode($dataPurchase,JSON_NUMERIC_CHECK))->with('credit',json_encode($creditPurchase,JSON_NUMERIC_CHECK));


        } catch (Exception $e) {
            //dd($e);
            return redirect('/phonelistUserLogin')->with('message',$e);
        }

    }
    public function googleNewUser(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:phone_list_user_models,email',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone'=>'required|unique:phone_list_user_models',
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            //$errors = $validator->errors();
            // return redirect()->back()->with('message', 'The email or phone number has already been taken');
            return redirect("/phonelistUserLogin")->with('message', 'phone number is invalid');
        } 
            $check = $this->create($data);
            PurchasePlan::create($check);
            Credit::create([
                'userId' => $check->id,
                'useableCredit' => 20,
            ]);
            CreditHistory::createNew($check);
            CSVExportSettings::create($check);
            // $token = Str::random(64);
  
            // PhoneListUserVerify::create([
            //   'user_id' => $check->id, 
            //   'token' => $token
            // ]);
  
            // Mail::send('email.emailForEmailVerification', ['token' => $token], function($message) use($request){
            //   $message->to($request->email);
            //   $message->subject('Email Verification Mail');
            // });
            return redirect("/phonelistUserLogin")->with('message', 'data Updated Successfully');
    }
    public function create(array $data)
    {
        return PhoneListUserModel::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'name' => $data['firstName'].' '.$data['lastName'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'purchasePlan' => 'Free',
            'useAbleCredit' => 20,
            'google_id' => $data['google_id'],
            'is_email_verified' => 1	
        ]);
    }
    public function handleGoogleCallbackRegister()
    {
        return view('user.userGoogleRegister');
    }
}
