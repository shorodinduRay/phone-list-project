<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\Credit;
use App\Models\Country;
use App\Models\PhoneList;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Models\DownloadedList;
use App\Models\InvoiceHistory;
use App\Models\SetPurchasePlan;
use App\Models\CSVExportSettings;
use App\Models\PhoneListUserModel;
use Illuminate\Support\Facades\DB;
use App\Models\PhoneListUserVerify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    protected $email;
    protected $password;
    protected $emailAuth;
    protected $passwordAuth;
    protected $data;
    protected $id;
    protected $user;
    protected $allData;
    protected $credit;
    protected $creditHistory;
    protected $exportHistory;
    protected $purchasePlan;
    protected $creditHistorydate;
    protected $allDataIds;
    protected $allDataIds2;
    protected $countries;
    protected $dataAll;



    public function dashboard()
    {
        // to handle -1 error in credit
        $this->dataAll = DB::table('phone_lists')
                            ->whereNotNull('phone')
                            ->count();
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        if ($this->credit->useableCredit == -1)
        {
            Credit::errorCredit();
        }
        $this->creditHistory = CreditHistory::where('userId',Auth::user()->id)->orderBy('date', 'desc')->get();
        $this->purchasePlan = PurchasePlan::where('userId',Auth::user()->id)->orderBy('start', 'desc')->get();
        $this->creditHistorydate = CreditHistory::where('userId',Auth::user()->id)->orderBy('date', 'desc')->get();

        $date = [];
        $k=0;
        foreach ($this->creditHistorydate as $historyDate)
        {
            if( $k < 7)
            {
                $date [$k] = $historyDate->date;
                $k++;
            }   
        }

        $i=0;
        $dataPurchase = [];
        foreach ($this->creditHistory as $history)
        {
            if( $i < 7)
            {
                $dataPurchase [$i] = $history->dataPurchase;
                $i++;
            }

        }

        // 7 days history
        $j=0;
        $creditPurchase = [];
        foreach ($this->purchasePlan as $plan)
        {
        if( $j < 7)
        {
            if($date[$j] == $plan->start)
            {
                $creditPurchase [$j] = $plan->credit;
            }
            else
            {
                $creditPurchase [$j] = 0;
            }

            $j++;
        }
        }
        return view('userDashboard.userDashboard',['userHistory'=> $this->creditHistory, 'mobile_number'=> $this->dataAll ])->with('data',json_encode($dataPurchase,JSON_NUMERIC_CHECK))->with('credit',json_encode($creditPurchase,JSON_NUMERIC_CHECK))->with('day',json_encode($date,JSON_NUMERIC_CHECK));

    }

    public function userRegister()
    {
        return view('user.userRegister');
    }

    public function newUser(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:phone_list_user_models,email',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone'=>'required|min:11|numeric|unique:phone_list_user_models',
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            //$errors = $validator->errors();
            return redirect()->back()->with('message1', 'The email or phone number has already been taken');
        } else {
            $check = $this->create($data);
            $newUser = PhoneListUserModel::where('email', $data['email'])->first();
            PurchasePlan::create($newUser);
            Credit::create([
                'userId' => $newUser->id,
                'useableCredit' => 20,
            ]);
            CreditHistory::createNew($newUser);
            CSVExportSettings::create($newUser);
            $token = Str::random(64);
  
            PhoneListUserVerify::create([
              'user_id' => $check->id, 
              'token' => $token
            ]);
  
            Mail::send('email.emailForEmailVerification', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
          });
            return redirect("/phonelistUserLogin")->with('message', 'data Updated Successfully');
        }
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
            'date' => date('Y-m-d'),
        ]);
    }
    public function verifyEmail($token)
    {
        $verifyUser = PhoneListUserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('/phoneListUserLogin')->with('message', $message);
    }


    /** start updating user information*/
    public function updateUserFirstName(Request $request, $id)
    {
        $this->user = PhoneListUserModel::where('id', $id)->update(['firstName' => $request->firstName]);
        return redirect()->back();

    }
    public function updateUserLastName(Request $request, $id)
    {
        $this->user = PhoneListUserModel::where('id', $id)->update(['lastName' => $request->lastName]);
        return redirect()->back();

    }
    public function updateUserTitle(Request $request)
    {
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['title' => $request->title]);
        return redirect()->back();

    }
    public function updateUserPhone(Request $request, $id)
    {
        $this->user = PhoneListUserModel::where('id', $id)->update(['phone' => $request->phone]);
        return redirect()->back();

    }
    public function updateUserAddress(Request $request)
    {
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['address' => $request->address]);
        return redirect()->back();

    }
    public function updateUserCountry($id)
    {
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['country' => $id]);
        return redirect()->back();
    }
    public function updateUserEmail(Request $request, $id)
    {
        $user = PhoneListUserModel::find(Auth::user()->id);
        
        if ($user->email == $request->email)
        {
            return redirect()->route('account')->with('message', 'New Email is required' );
        }
        else
        {
            $token = Str::random(64);
            UserVerify::create([
              'user_id' => $id, 
              'token' => $token,
              'email' => $request->email
            ]);
            if ($user->google_id != null)
            {
                Mail::send('email.emailVerificationEmailWithPassword', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Email Verification Mail to ');
                });
                return redirect()->back()->with('message', 'Pending confirmation to change email to '.$request->email );
            }
            else
            {
                Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Email Verification Mail to ');
                });
                return redirect()->back()->with('message', 'Pending confirmation to change email to '.$request->email );
            }
            //$this->user = PhoneListUserModel::where('id', $id)->update(['email' => $request->email]);
            
        }

    }
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            PhoneListUserModel::where('id', $verifyUser->user_id)->update(['email' => $verifyUser->email]);
            $message = "Your e-mail is verified. You can now login.";
            $verifyUser->delete();
        }
  
      return redirect()->route('/phonelistUserLogin')->with('message', $message);
    }
    public function updateUserPassword(Request $request, $id)
    {
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        //Notification info
        $icon = "bi bi-shield-lock-fill";
        $title = "You changed your password.";
        $description = "You requested to change your password. This change is pending confirmation. Please check your email to complete this change.";
        addNotification($title, $description, $icon);

        return redirect()->back();

    }

    public function notificationDetails()
    {
        $notifications = Notification::orderBy('status')->where('user_id', Auth::user()->id)->get();
        //Update notification status to read.
        Notification::where('user_id', Auth::user()->id)->update(['status' => 1]);

        return view('userDashboard.notifications-details', ['notifications' => $notifications]);
    }
    
    public function updateUserInfo($array)
    {
        $myArray = explode(',', $array);
        $address = array_slice($myArray,5);
        $myAddress = implode(',', $address);
        //dd($myAddress);

        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['firstName' => $myArray[1]]);
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['lastName' => $myArray[2]]);
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['title' => $myArray[3]]);
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['phone' => $myArray[4]]);
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['address' => $myAddress]);
        return redirect()->back();

    }
    /** end updating user information*/
    /** start add/updating user billing information*/

    public function addCardInfo(Request $request)
    {
        Card::create([
            'userId' => $request->userId,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'creditCardNumber' => $request->creditCardNumber,
            'expirationDate' => $request->expirationDate,
            'cvc' => $request->cvc,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postalCode' => $request->postalCode,
        ]);
        return redirect()->route('billing');
    }
    public function updateCardInfo(Request $request)
    {
        Card::where('id', $request->cardId)->update([
            'userId' => $request->userId,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'creditCardNumber' => $request->creditCardNumber,
            'expirationDate' => $request->expirationDate,
            'cvc' => $request->cvc,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postalCode' => $request->postalCode,
        ]);
        return redirect()->route('billing');
    }
    public function removeCard()
    {
        Card::where('userId', Auth::user()->id)->delete();
        return redirect()->route('billing');
    }

    /** end add/updating user billing information*/

    public function userLogin()
    {
        return view('user.userLogin');
    }
    public function userLoginAuth(Request $request)
    {
        return view('user.userLogin');
    }

    public function userAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $result = $request->email;
            $this->data = PhoneListUserModel::where('email', 'LIKE', $result. '%'  )->get();
            return redirect('search')
                ->with( ['userData' => $this->data] )
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("/phonelistUserLogin")->with('message','Oppes! You have entered invalid credentials');


    }

    public function handleGoogleRegister($userArray)
    {
        $this->data = $userArray;
        return view('user.', ['newUserData'=>$this->data]);
    }

    public function people()
    {
        $this->countries = Country::all();
        $dataCount = QueryBuilder::for(PhoneList::class)
            ->select('id')
            ->count();
        return view('userDashboard.people', ['country' => $this->countries, 'count'=>$dataCount]);
    }
    public function people_search(Request $request)
    {
        $this->countries = Country::all();
        $this->allData = QueryBuilder::for(PhoneList::class)
            ->select(
                'id',
                'first_name',
                'last_name',
                'age',
                'work',
                'country',
                'gender',
                'relationship_status',
                'education_last_year',
                'location',
                'location_city',
                'hometown',
                'hometown_city'
            )
            ->where('first_name', '=', $request->people)
            ->orWhere('last_name', '=', $request->people)
            ->orWhere('full_name', '=', $request->people)
            ->orWhere('location', '=', $request->people)
            ->orWhere('location_city', '=', $request->people)
            ->orWhere('location_city', '=', ' ' . $request->people)
            ->orWhere('location_state', '=', ' ' . $request->people)
            ->orWhere('location_state', '=', ' ' . $request->people . "'")
            ->orWhere('location_region', '=', ' ' . $request->people)
            ->orWhere('hometown', '=', $request->people)
            ->orWhere('hometown_city', '=', $request->people)
            ->orWhere('hometown_city', '=', ' ' . $request->people)
            ->orWhere('hometown_state', '=', ' ' . $request->people)
            ->orWhere('hometown_state', '=', ' ' . $request->people . "'")
            ->orWhere('hometown_region', '=', ' ' . $request->people)
            ->orWhere('country', '=', $request->people)
            ->orWhere('gender', '=', $request->people)
            ->orWhere('relationship_status', '=', $request->people)
            ->orWhere('age', 'like', '%/'.$request->people)
            ->take(15)
            ->get();

        /*$query =  DB::table('phone_lists');
        $query->where('full_name', 'like', '%'.$request->people.'%')
            ->orWhere('location', 'like', '%'.$request->people.'%')
            ->orWhere('hometown', 'like', '%'.$request->people.'%')
            ->orWhere('country', '=', $request->people)
            ->orWhere('gender', '=', $request->people)
            ->orWhere('relationship_status', '=', $request->people)
            ->orWhere('age', 'like', '%/'.$request->people);
        $this->allData = $query->orderBy('full_name', 'ASC')
                                ->take(15)
                                ->get();*/
        return view('userDashboard.people', ['allData' => $this->allData, 'country' => $this->countries,
            'people' => $request->people]);
    }
    public function people_gender($gender)
    {
        $this->countries = Country::all();
        $this->data = DB::table('phone_lists')
            ->where('gender', '=', $gender)
            ->paginate(200);
        return view('front.gender', ['data'=>$this->data, 'country' => $this->countries])->with('dataId', $gender);
    }

    public function user($id)
    {
        $this->countries = Country::all();
        $this->data = Phonelist::find($id);
        $result = substr($this->data->first_name, 0, 3);
        $this->userData = PhoneList::where('full_name', 'LIKE', $result. '%'  )->take(6)->get();

        return view('userDashboard.user.user', ['data'=>$this->data, 'country' => $this->countries])->with('userData', $this->userData);
    }

    public function searchCountry($id)
    {
        $countries = Country::all();
        $data = PhoneList::where('country', 'like', $id . '%')->simplePaginate(200)->withQueryString();
        return view('userDashboard.country.country', ['data' => $data,  'country' => $countries])->with('dataId', $id);
    }


    public function peopleSearchById($id)
    {

        $this->countries = Country::all();
        $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds)
        {
            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        $this->allData = PhoneList::where('id', $id )->orderBy('full_name', 'ASC')->paginate(15);
        return view('userDashboard.people', ['allData' => $this->allData, 'country' => $this->countries]);
    }

    public function peopleDataHistory(Request $request)
    {
        if($request->ajax())
        {
            $credit=Credit::where('userId',Auth::user()->id)->first();
            if ($credit->useableCredit >= 1)
            {
                Credit::updateUserCreditForOne($request);
                PhoneListUserModel::updateUseAbleCreditForOne($request, Auth::user()->id);
                ExportHistori::newExportHistoriForOne($request);
                DownloadedList::createForOne($request);
                CreditHistory::createForOne($request);
                $data = DB::table('phone_lists')
                    ->where('id', '=', $request->id)
                    ->get();
                echo json_encode($data);
            }

        }
    }


    public function peopleSearch(Request $request)
    {
        $this->countries = Country::all();
        $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds)
        {
            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        $result = $request->name;
        $this->allData = DB::table('phone_lists')
            ->whereNotIn('id', explode(',',$getdownloadedIds))
            ->where('first_name', '=',  $result)
            ->orWhere('last_name', '=',  $result)
            ->orWhere('full_name', '=',  $result)
            ->orderBy('first_name', 'ASC')
            ->paginate(15);
        return view('userDashboard.people', ['allDataName' => $this->allData, 'country' => $this->countries, 'res' => $result]);
    }
    public function account()
    {
        $email_verification = UserVerify::where('user_id', Auth::user()->id)->first();
        //dd($email_verification->email);
        if (is_null($email_verification))
        {
            return view('userDashboard.settings.account');
        }
        else
        {
            return view('userDashboard.settings.account',['messages' => 'Pending confirmation to change email to '.$email_verification->email]);
        }
    }
    public function managePlan()
    {
        $data = PurchasePlan::where('userId', Auth::user()->id)->get();
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $items[0] = $data->last()->plan;
        $items[1] = $this->credit->useableCredit;

        $items[2] = $this->credit->useableCredit;
        $items[3] = $data->last()->price;

        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[4] = $monthName; $items[5] = $year; $items[6] = $day;
        //$date2 = Carbon::createFromFormat('Y-m-d', $data->last()->end);
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[7] = $monthName2; $items[8] = $day2; $items[9] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[10] = 0;
        $items[11] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[10]= $items[10]+$credithistory->usedCredit;
        }


        return view('userDashboard.settings.plans.managePlan', ['userPurchasePlan' => $items]);
    }

    public function billing()
    {
        $data = Card::where('userId', Auth::user()->id)->get();
        $invoice = InvoiceHistory::where('userId', Auth::user()->id)->orderBy('created_at', 'desc')->simplePaginate(2);
        if( $invoice!= null )
        {
            return view('userDashboard.settings.plans.billing', ['userCardInfo' => $data, 'invoices'=> $invoice, 'amount'=>0]);
        }
        return view('userDashboard.settings.plans.billing', ['userCardInfo' => $data, 'amount'=>0]);
    }
    public function billingRequest(Request $request)
    {
        $plan = SetPurchasePlan::find($request->planId);
        $data = Card::where('userId', Auth::user()->id)->get();
        $invoice = InvoiceHistory::where('userId', Auth::user()->id)->orderBy('created_at', 'desc')->simplePaginate(2);
        if( $invoice!= null )
        {
            return view('userDashboard.settings.plans.billingRequest', ['userCardInfo' => $data, 'purchasePlan'=>$plan, 'invoices'=>$invoice]);
        }
        return view('userDashboard.settings.plans.billingRequest', ['userCardInfo' => $data, 'purchasePlan'=>$plan]);
        // $data = Card::where('userId', Auth::user()->id)->get();
        // return view('userDashboard.settings.plans.billingRequest', ['userCardInfo' => $data, 'purchasePlan'=>$request]);
    }
    public function reDownloadInvoice($file)
    {
        $data = InvoiceHistory::where('invoiceId',$file)->first();
        return response()->download('storage/app/'. $data->pdf,'invoice.pdf');

    }


    public function exports()
    {
        $data = ExportHistori::where('userId',Auth::user()->id)->orderBy('createdOn', 'desc')->paginate(9);
        return view('userDashboard.settings.exports.exports', ['exportHistory' => $data]);
    }
    public function customCsvSettings(Request $request)
    {
        CSVExportSettings::customization($request);
        $data = CSVExportSettings::where('userId', Auth::user()->id)->first();
        return view('userDashboard.settings.exports.csv-export-settings', ['csvSettings'=> $data->collumn]);
    }
    public function reDownloadFile($file_name)
    {
        $data = ExportHistori::find($file_name);
        return response()->download('storage/app/'. $data->file,'phonelist.xlsx');
    }
    public function csvExportSettings()
    {
        $data = CSVExportSettings::where('userId', Auth::user()->id)->first();
        return view('userDashboard.settings.exports.csv-export-settings', ['csvSettings'=> $data->collumn]);
    }
    public function current()
    {
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[1] = $monthName; $items[2] = $year; $items[3] = $day;
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[4] = $monthName2; $items[5] = $day2; $items[6] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[7] = 0;
        $items[8] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[7]= $items[7]+$credithistory->usedCredit;
        }

        return view('userDashboard.settings.credits.current', ['userPurchasePlan' => $items]);
    }
    public function history()
    {
        //$this->creditHistory = ExportHistori::where('userId', Auth::user()->id)->get();
        //dd($this->creditHistory);
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[1] = $monthName; $items[2] = $year; $items[3] = $day;
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[4] = $monthName2; $items[5] = $day2; $items[6] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[7] = 0;
        $items[8] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[7]= $items[7]+$credithistory->usedCredit;
        }
        return view('userDashboard.settings.credits.history', ['userPurchasePlan' => $items]);
    }

    public function historyDate(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != '' && $request->to_date != '')
            {
                $data = DB::table('credit_histories')
                    ->whereBetween('date', array($request->from_date, $request->to_date))
                    ->get();
            }
            else
            {
                $data = DB::table('credit_histories')->orderBy('date', 'desc')->get();
            }
            echo json_encode($data);
        }
    }

    public function upgradeUser()
    {
        return view('userDashboard.settings.upgrade');
    }
    public function upgradeUserPayment()
    {
        //dd($method);
        return view('userDashboard.settings.upgrade', ['paypal'=> "paypal"]);
    }
    public function upgradeUserNewPayment()
    {
        //dd($method);
        return view('userDashboard.settings.upgrade', ['bitcoin'=> "bitcoin"]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
