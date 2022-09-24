<?php

namespace App\Http\Controllers\Admin\Payment;

use Redirect;
use Carbon\Carbon;
use App\Models\Card;
use App\Models\Credit;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use App\Models\InvoiceHistory;
use App\Models\PhoneListUserModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Victorybiz\LaravelCryptoPaymentGateway\LaravelCryptoPaymentGateway;

class PaymentController extends Controller
{
    protected $newUser;
    protected static $user;
    protected static $card;
    protected static $invoiceNum;
    protected static $plan;

    public function callback(Request $request)
    {
        return LaravelCryptoPaymentGateway::callback();
    }
    public function payNow(Request $request)
    {
        $description = $request->dataFilter . ' ' . $request->phoneNumber . ' phone numbers.';
        $price = $request->price;
        $callbackUrl = $this->getCallbackurl($price);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-sandbox.nowpayments.io/v1/payment',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "price_amount": ' . $price . ',
            "price_currency": "usd",
            "pay_currency": "btc",
            "ipn_callback_url": "' . $callbackUrl . '",
            "order_id": "RGDBP-21314",
            "order_description": "' . $description . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: HKA2W76-QJ44HDE-K1SHGSP-00FENBS',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        self::$plan = PurchasePlan::createNewOne($request);
        Credit::updateCreditByBTC($request);
        PhoneListUserModel::updatePlanAndCreditByBTC($request);
        $invoice = self::invoice($request);
        
        $response = json_decode($response);
        //TODO store response in database....

        return view('userDashboard.settings.plans.payment-success', ['response' => $response]);

        // dd($response);
        // return Redirect::to($response->ipn_callback_url);
    }

    private function getCallbackurl($price)
    {
        if ($price == 100) {
            return "https://sandbox.nowpayments.io/payment/?iid=4323803483";
        } elseif ($price == 190) {
            return "https://sandbox.nowpayments.io/payment/?iid=5297634833";
        } elseif ($price == 400) {
            return "https://sandbox.nowpayments.io/payment/?iid=4345302541";
        } elseif ($price == 1000) {
            return "https://sandbox.nowpayments.io/payment/?iid=5039006412";
        } elseif ($price == 1500) {
            return "https://sandbox.nowpayments.io/payment/?iid=5256332987";
        }
    }

    public static function invoice($request)
    {
        self::$user = PhoneListUserModel::where('id', $request->userId)->get();
        self::$card = Card::where('userId', $request->userId)->first();
        self::$invoiceNum = InvoiceHistory::latest("invoiceId")->first();
        foreach (self::$user as $userInfo){
            $data["name"] = $userInfo->firstName.' '.$userInfo->lastName;
            $data["email"] = $userInfo->email;
            $data["country"]= $userInfo->country;
            $data["date"]= Carbon::now()->toString();
            $data["paidBy"]= $request->paidBy;
            $data["amount"]= $request->price;
            $data["credit"]= $request->credit;
            $data["phoneNumber"]= $request->phoneNumber;
            $data["dataFilter"]= $request->dataFilter;
            $data["csvExport"]= $request->csvExport;


            $data["total"]= $request->price;
        }

        if (self::$card)
        {
            $data["address"]= self::$card->address;
            $data["city"]= self::$card->city;
            $data["state"]= self::$card->state;
        }

        if( self::$invoiceNum == null )
        {
            $data["invoiceNum"] = "1001";
        }
        else{
            $data["invoiceNum"] = (int) self::$invoiceNum->invoiceId + 1;
        }
        
        //$data["plan"] = self::$plan->plan;

        $data["title"] = "From phonelist.io";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('myTestMail', $data)->setOptions(['defaultFont' => 'sans-serif']);
        InvoiceHistory::createInvoice($pdf, $request, "USDD");

        Mail::send('myTestMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "invoice.pdf");
        });
        
        // InvoiceHistory::create ([
        //     "userId" => Auth::user()->id,
        //     "paidBy" => "stripe",
        //     "amount" => $request->price,
        //     "pdf" => saveFileForOne($request),
        // ]);
    }

}
