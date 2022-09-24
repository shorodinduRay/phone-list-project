<?php

namespace App\Http\Controllers\User\Payment;

use Stripe;
use Exception;
use Stripe\Token;
use Carbon\Carbon;
use App\Models\Card;
use App\Models\Credit;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use App\Models\CreditHistory;
use App\Models\InvoiceHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PhoneListUserModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    protected $newUser;
    protected static $user;
    protected static $card;
    protected static $invoiceNum;    /*
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function stripe()
    {
        return view('stripe');
    }*/

    /**
     * success response method.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function stripeAccess(Request $request)
    {
        $data = Card::where('userId', $request->userId)->first();
        if($data)
        {
            try {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $stripeToken = Token::create(array(
                    "card" => array(
                        "number"    =>$data->creditCardNumber,
                        "exp_month" =>intval(str_before($data->expirationDate, '/')),
                        "exp_year"  =>intval(str_after($data->expirationDate, '/')),
                        "cvc"       => $data->cvc,
                        "name"      => $data->firstName . " " . $data->lastName
                    )
                ));

                Stripe\Charge::create ([
                    "amount" => ($request->price) * 100,
                    "currency" => "usd",
                    "source" => $stripeToken,
                    "description" => "This payment is tested purpose phpcodingstuff.com"
                ]);
                PurchasePlan::createNew($request);
                Credit::updateCredit($request);
                PhoneListUserModel::updatePlanAndCredit($request);


                self::invoice($request);

                //Notification info
                $icon = "bi bi-lightning-fill";
                $title = "You upgraded your plan.";
                $description = "You have upgraded your plan.";
                addNotification($title, $description, $icon);

                Session::flash('success', 'Payment successful!');
                return redirect('/settings/plans');

            }catch (Exception $e){
                return redirect('/settings/billing')->with('message', $e->getMessage());
            }

        }
        else
        {
            $data = Card::where('userId', Auth::user()->id)->get();
            return view('userDashboard.settings.plans.billing',['userCardInfo' => $data,'amount'=>$request]);
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
        InvoiceHistory::createInvoice($pdf, $request, "stripe");

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
