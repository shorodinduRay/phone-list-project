<?php

namespace App\Http\Controllers\Admin\Payment;

use Notification;
use Carbon\Carbon;
use App\Models\Card;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use App\Models\Credit;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;

/** All Paypal Details class **/
use PayPal\Api\RedirectUrls;
use App\Models\InvoiceHistory;
use PayPal\Common\PayPalModel;
use Barryvdh\DomPDF\Facade\Pdf;
use PayPal\Api\PaymentExecution;
use App\Models\PhoneListUserModel;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use PayPal\Exception\PPConnectionException;
use Illuminate\Http\Client\ConnectionException;
use App\Http\Controllers\User\Payment\StripeController;

class PayPalPaymentController extends Controller
{
    protected static $user;
    protected static $card;
    private $purchaseValue;
    protected static $invoiceNum;
    protected static $plan;
    public function handlePayment($price)
    {

    }
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    public function payWithpaypal(Request $request)
    {

        if ($request->price == 0)
        {
            return redirect('/settings/upgrade')->with('message','please choose your plan first');
        }
        else
        {
            $this->purchaseValue = $request;
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();

            $item_1->setName("$request->plan") /** item name **/
            ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->price); /** unit price **/

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($request->price);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));


            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
            try {

                $payment->create($this->_api_context);

            } catch (ConnectionException $ex) {

                if (Config::get('app.debug')) {

                    Session::put('error', 'Connection timeout');
                    return Redirect::to('/');

                } else {

                    Session::put('error', 'Some error occur, sorry for inconvenient');
                    return Redirect::to('/');

                }

            }

            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;

                }

            }

            /** add payment ID to session **/
            Session::put('paypal_payment_id', $payment->getId());

            if (isset($redirect_url)) {

                /** redirect to paypal **/
                return Redirect::away($redirect_url);

            }

            Session::put('error', 'Unknown error occurred');
            return Redirect::to('/settings/billing');
        }

    }

    public function getPaymentStatus()
    {

        $request=request();//try get from method

        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        //if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
        if (empty($request->PayerID) || empty($request->token)) {

            Session::put('error', 'Payment failed');
            return Redirect::to('/settings/billing');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        //$execution->setPayerId(Input::get('PayerID'));
        $execution->setPayerId($request->PayerID);

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            Session::put('success', 'Payment success');
            //add update record for cart
            PurchasePlan::createNew($this->purchaseValue);
            Credit::updateCradit($this->purchaseValue);

            self::invoice($request);

            //Notification info
            $icon = "bi bi-lightning-fill";
            $title = "You upgraded your plan.";
            $description = "You have upgraded your plan.";
            addNotification($title, $description, $icon);

            return redirect('/settings/plans'); //back to product page

        }

        Session::put('error', 'Payment failed');
        return Redirect::to('/settings/billing');

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
