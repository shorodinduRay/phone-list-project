<?php

namespace App\Http\Controllers;

use App\Exports\CustomExport;
use App\Jobs\PhoneCsvProcess;
use App\Models\Country;
use App\Models\Credit;
use App\Models\CreditHistory;
use App\Models\DownloadedList;
use App\Models\ExportHistori;
use App\Models\PhoneListUserModel;
use App\Models\PurchasePlan;
use App\Models\SetPurchasePlan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PhoneListImport;
use App\Exports\PhoneListExport;
use App\Models\Card;
use App\Models\CSVExportSettings;
use App\Models\InvoiceHistory;
use App\Models\PhoneList;
use Maatwebsite\Excel\Files\Disk;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Auth\Events\Validated;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Storage;
use Stripe\Customer;

class AdminController extends Controller
{

    protected $data;
    protected $allData;
    protected $purchasePlan;
    protected $user;
    protected $credit;
    protected $plan;
    protected static $phoneList;
    protected static $invoices;
    protected static $credits_used;
    protected static $countRow;
    protected static $total_credit;
    protected static $total_credit_by_card;
    protected static $total_credit_by_crypto;

    // view admin Dashboard

    public function index()
    {
        return view('admin.dashboard');
    }

    
    public function fileImportExport()
    {
        //return view('file-import');
    }


    public function fileImport(Request $request)
    {
        if ($request->has('file')) {
            $phoneArray = PhoneList::pluck('phone')->toArray();
            $csv = file(request()->file);
            $chunks = array_chunk($csv, 1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);

                if ($key == 0) {
                    $header = $data[0];
                    unset($data[0]);
                }

                if (isset($data)) {
                    $batch->add(new PhoneCsvProcess(mb_convert_encoding($data, 'UTF-8', 'UTF-8'), $header, $phoneArray));
                }
            }
            // return $batch;
            return back()->with('message', 'Successfully imported file!');
        }
        return back()->with('message', 'Please Upload file!');
    }

    public function fileExport()
    {
        return Excel::download(new PhoneListExport, 'phoneList-collection.xlsx');
    }


    public function customExport(Request $request)
    {
        if ($request->chk == null) {
            $credit = Credit::where('userId', Auth::user()->id)->first();
            $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
            $getdownloadedIds = 0;
            foreach ($this->allDataIds as $dataIds) {
                $getdownloadedIds = $getdownloadedIds . ',' . $dataIds->downloadedIds;
            }

            $query = DB::table('phone_lists')
                ->whereNotIn('id', explode(',', $getdownloadedIds));
            if (isset($request->name) != null)
                $query->where('first_name', '=', $request->name)
                    ->orWhere('last_name', '=', $request->name)
                    ->orWhere('full_name', '=', $request->name);

            if (isset($request->location) != null)
                $query->where('location', '=', $request->location)
                    ->orWhere('location_city', '=', $request->location)
                    ->orWhere('location_city', '=', ' ' . $request->location)
                    ->orWhere('location_state', '=', ' ' . $request->location)
                    ->orWhere('location_state', '=', ' ' . $request->location . "'")
                    ->orWhere('location_region', '=', ' ' . $request->location);
            if (isset($request->hometown) != null)
                $query->where('hometown', '=', $request->hometown)
                    ->orwhere('hometown_city', '=', $request->hometown)
                    ->orwhere('hometown_city', '=', ' ' . $request->hometown)
                    ->orWhere('hometown_state', '=', ' ' . $request->hometown)
                    ->orWhere('hometown_state', '=', ' ' . $request->hometown . "'")
                    ->orWhere('hometown_region', '=', ' ' . $request->hometown);
            if (isset($request->country) != null)
                $query->where('country', '=', $request->country);
            if (isset($request->age) != null) {
                $validated = $request->age->validate([
                    'age' => 'required|digits:4',
                ]);
                $age = $validated['age'];
                $query->where('age', 'like', '%/' . $age);
            }

            if (isset($request->gender) != null)
                $query->where('gender', '=', $request->gender);
            if (isset($request->relationship_status) != null)
                $query->where('relationship_status', '=', $request->relationship_status);

            if ($request->limit != null) {
                $allData = $query->orderBy('id', 'ASC')->pluck('id')->take($request->limit);
            } else {
                $allData = $query->orderBy('id', 'ASC')->pluck('id');
            }
            $array = $allData->toArray();
            $preDownloaded = count($array);
            $preDownloaded2 = $preDownloaded - (count(array_intersect($allData->toArray(), explode(',', $getdownloadedIds))));

            if ($credit->useableCredit >= $preDownloaded2) {
                Credit::allDataCradit($preDownloaded, $array);
                ExportHistori::allDataExportHistori($preDownloaded, $allData);
                DownloadedList::createAllNew($allData);
                CreditHistory::createAll($preDownloaded);
                PhoneListUserModel::updateUseAbleCredit($allData);

                return (new CustomExport($allData->toArray()))->download('phoneList.xlsx');
            } else {
                return redirect('/settings/upgrade');
            }
        } else {
            $credit = Credit::where('userId', Auth::user()->id)->first();
            $allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
            $getdownloadedIds = 0;
            foreach ($allDataIds as $dataIds) {

                $getdownloadedIds = $getdownloadedIds . ',' . $dataIds->downloadedIds;
            }
            $preDownloaded = count($request->chk) - (count(array_intersect($request->chk, explode(',', $getdownloadedIds))));


            if ($credit->useableCredit >= $preDownloaded) {
                Credit::updateUserCradit($request);
                ExportHistori::newExportHistori($request);
                DownloadedList::createNew($request);
                CreditHistory::create($request);
                PhoneListUserModel::updateUseAbleCredit($request);

                return (new CustomExport($request->chk))->download('phoneList.xlsx');
            } else {
                return redirect('/settings/upgrade');
            }
        }
    }




    //  admin Dashboard view all data // data edit update delete


    public function manageData()
    {
        //dd('hello');
        $this->allData = PhoneList::paginate(10);
        $rowCount = PhoneList::count();
        return view('admin.manage-data', ['allData' => $this->allData, 'rowcount' => $rowCount]);
    }
    public function editPhoneListData(Request $request)
    {
        PhoneList::updatePhoneList($request);
        $this->allData = PhoneList::paginate(10);
        return redirect(route('view.all'))->with('message', 'Successfully updated data!');
    }
    public function peopleSearch(Request $request)
    {
        //dd($request->search);
        if ($request->search == null) {
            return redirect()->back()->with('message', 'Search is Empty');
        }
        $result = $request->search;
        $this->allData = DB::table('phone_lists')
            ->where('first_name', '=',  $result)
            ->orWhere('last_name', '=',  $result)
            ->orWhere('full_name', '=',  $result)
            ->orWhere('phone', '=',  $result)
            ->orderBy('full_name', 'ASC')
            ->paginate(15);
        $rowCount = DB::table('phone_lists')
            ->where('first_name', '=',  $result)
            ->orWhere('last_name', '=',  $result)
            ->orWhere('full_name', '=',  $result)
            ->orWhere('phone', '=',  $result)
            ->count();
            
        if($this->allData->isEmpty())
        {
            return view('admin.manage-data', ['allDataName' => $this->allData, 
                            'res' => $result, 'rowcount' => $rowCount, 'notFound' => "No Data Found"]);
        }
        return view('admin.manage-data', ['allDataName' => $this->allData, 'res' => $result, 'rowcount' => $rowCount]);
    }

    public function manageUser()
    {
        //dd('hello');
        $this->allData = PhoneListUserModel::paginate(10);
        return view('admin.manage-user', ['allData' => $this->allData]);
    }
    public function deleteUserData($id)
    {
        $this->data = PhoneListUserModel::find($id);
        $this->data->delete();
        $this->data = Card::where('userId',$id)->first();
        $this->data->delete();
        $this->data = Credit::where('userId',$id)->first();
        $this->data->delete();
        CreditHistory::deleteUser($id);
        $this->data = CSVExportSettings::where('userId',$id)->first();
        $this->data->delete();
        DownloadedList::deleteUser($id);
        ExportHistori::deleteUser($id);
        PurchasePlan::deleteUser($id);
        return redirect(route('view.all.user'))->with('message', 'Successfully deleted data!');
    }

    public function addNewUser()
    {
        $this->countries = Country::all();
        return view('admin.newUser', ['country' => $this->countries]);
    }
    public function addNewUserByAdmin(Request $request)
    {
        $this->countries = Country::all();
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:phone_list_user_models,email',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required|min:11|numeric|unique:phone_list_user_models',
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            //$errors = $validator->errors();
            //return redirect()->route('admin.login')->with('message', 'Email and/or password do not match with any of our records.'); 
            view('admin.newUser', ['country' => $this->countries, 'message' => 'The email or phone number has already been taken!']);
            //return redirect()->back()->with('message', 'The email or phone number has already been taken')->with(['country' => $this->countries]);
        } else {
            $check = $this->create($data);
            $newUser = PhoneListUserModel::where('email', $data['email'])->first();
            PurchasePlan::create($newUser);
            Credit::create([
                'userId' => $newUser->id,
                'useableCredit' => 20,
            ]);
            CreditHistory::createNew($newUser);
        }

        //return redirect()->back()->with('message', 'Successfully added user!')->with(['country' => $this->countries]);
        return view('admin.newUser', ['country' => $this->countries, 'message' => 'Successfully added user!']);
    }
    public function resetUserPassword(Request $request)
    {
        $this->countries = Country::all();
        $user = PhoneListUserModel::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return view('admin.newUser', ['country' => $this->countries, 'message' => 'Successfully updated password!']);
    }

    public function create(array $data)
    {
        return PhoneListUserModel::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'name' => $data['firstName'] . ' ' . $data['lastName'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'purchasePlan' => 'Free',
            'useAbleCredit' => 20,
            'date' => date('Y-m-d'),
        ]);
    }

    public function creditTransfer()
    {
        $this->allData = PhoneListUserModel::paginate(10);
        return view('admin.creditTransfer', ['userData' => $this->allData]);
    }


    public function getCreditHistory()
    {
        $days = 7;
        $format = "Y-m-d";
        $m = date("m");
        $de = date("d");
        $y = date("Y");
        $dateArray = array();
        for ($i = 0; $i <= $days - 1; $i++) {
            $dateArray[] = '' . date($format, mktime(0, 0, 0, $m, ($de - $i), $y)) . '';
        }
        // dd($dateArray);
        $newCustomerArray = [];
        foreach ($dateArray as $key => $date) {
            $customer = PhoneListUserModel::where('date', $date)->count();
            array_push($newCustomerArray, $customer);
        }

        $newCustomerArray = [];
        foreach ($dateArray as $key => $date) {
            $customer = PhoneListUserModel::where('date', $date)->count();
            array_push($newCustomerArray, $customer);
        }
        self::$invoices = InvoiceHistory::orderBy('updated_at', 'desc');
        self::$credits_used = self::$invoices->get();

        self::$total_credit = 0;
        foreach(self::$credits_used as $credits)
        {
            self::$total_credit = self::$total_credit + $credits->credit ;
        }
        //$invoices = InvoiceHistory::orderBy('updated_at', 'desc')->simplePaginate(5);
        return view('admin.credit-history', ['dates' => $dateArray, 'customers' => $newCustomerArray,'orders'=> self::$invoices->simplePaginate(5), 'credit_earned'=> self::$total_credit]);
    }
    public function creditSearch(Request $request)
    {
        $days = 7;
        $format = "Y-m-d";
        $m = date("m");
        $de = date("d");
        $y = date("Y");
        $dateArray = array();
        for ($i = 0; $i <= $days - 1; $i++) {
            $dateArray[] = '' . date($format, mktime(0, 0, 0, $m, ($de - $i), $y)) . '';
        }
        // dd($dateArray);
        $newCustomerArray = [];
        foreach ($dateArray as $key => $date) {
            $customer = PhoneListUserModel::where('date', $date)->count();
            array_push($newCustomerArray, $customer);
        }

        $newCustomerArray = [];
        foreach ($dateArray as $key => $date) {
            $customer = PhoneListUserModel::where('date', $date)->count();
            array_push($newCustomerArray, $customer);
        }

        self::$invoices = InvoiceHistory::orderBy('updated_at', 'desc');
        self::$credits_used = self::$invoices->get();

        self::$total_credit = 0;
        foreach(self::$credits_used as $credits)
        {
            self::$total_credit = self::$total_credit + $credits->credit ;
        }
        if ($request->search == null) {
            return redirect()->back()->with('message', 'Search is Empty');
        }
        $result = $request->search;
        $foundInvoices = DB::table('invoice_histories')
            ->where('invoiceId', '=',  $result)
            ->orderBy('invoiceId', 'DESC')
            ->paginate(5);
            
        if($foundInvoices->isEmpty())
        {
            return view('admin.credit-history', ['dates' => $dateArray, 'customers' => $newCustomerArray,
            'orders'=> $foundInvoices, 'credit_earned'=> self::$total_credit , 
            'notFound' => "No Data Found", 'res' => $result,]);
        }
        return view('admin.credit-history', ['dates' => $dateArray, 'customers' => $newCustomerArray,
        'orders'=> $foundInvoices, 'credit_earned'=> self::$total_credit, 'res' => $result]);
    }

    public function getOrderHistory()
    {
        self::$invoices = InvoiceHistory::orderBy('updated_at', 'desc');
        self::$credits_used = self::$invoices->get();
        self::$countRow = self::$invoices->count();

        self::$total_credit = 0;
        self::$total_credit_by_card = 0;
        self::$total_credit_by_crypto = 0;
        foreach(self::$credits_used as $credits)
        {
            self::$total_credit = self::$total_credit + $credits->amount ;
            if($credits->paidBy == "stripe")
            {
                self::$total_credit_by_card = self::$total_credit_by_card + $credits->amount;
            }
            if($credits->paidBy == "USDD")
            {
                self::$total_credit_by_crypto = self::$total_credit_by_crypto + $credits->amount;
            }
        }

        return view('admin.order-history', ['orders'=> self::$invoices->simplePaginate(5), 'total_sales'=> self::$total_credit, 'card_total'=> self::$total_credit_by_card, 'now_pay_total'=>self::$total_credit_by_crypto, 'count'=> self::$countRow ]);
    }

    public function invoiceSearch(Request $request)
    {
        self::$invoices = InvoiceHistory::orderBy('updated_at', 'desc');
        self::$credits_used = self::$invoices->get();
        self::$countRow = self::$invoices->count();

        self::$total_credit = 0;
        self::$total_credit_by_card = 0;
        self::$total_credit_by_crypto = 0;
        foreach(self::$credits_used as $credits)
        {
            self::$total_credit = self::$total_credit + $credits->amount ;
            if($credits->paidBy == "stripe")
            {
                self::$total_credit_by_card = self::$total_credit_by_card + $credits->amount;
            }
            if($credits->paidBy == "USDD")
            {
                self::$total_credit_by_crypto = self::$total_credit_by_crypto + $credits->amount;
            }
        }
        if ($request->search == null) {
            return redirect()->back()->with('message', 'Search is Empty');
        }
        $result = $request->search;
        $foundInvoices = DB::table('invoice_histories')
            ->where('invoiceId', '=',  $result)
            ->orderBy('invoiceId', 'DESC')
            ->paginate(5);
            
        if($foundInvoices->isEmpty())
        {
            return view('admin.order-history', ['orders'=> $foundInvoices, 'total_sales'=> self::$total_credit, 
            'card_total'=> self::$total_credit_by_card, 'now_pay_total'=>self::$total_credit_by_crypto, 
            'count'=> self::$countRow, 'notFound' => "No Data Found", 'res' => $result,]);
        }
        return view('admin.order-history', ['orders'=> $foundInvoices, 'total_sales'=> self::$total_credit, 
        'card_total'=> self::$total_credit_by_card, 'now_pay_total'=>self::$total_credit_by_crypto, 
        'count'=> self::$countRow, 'res' => $result ]);
    }

    
    public function updatePlan($planId, $id)
    {

        $this->plan = SetPurchasePlan::find($planId);
        Credit::updateCreditByAdmin($this->plan, $id);
        PhoneListUserModel::updatePlanAndCreditByAdmin($this->plan, $id);

        PurchasePlan::createNewByAdmin($this->plan, $id);




        $this->allData = PhoneListUserModel::paginate(10);

        return redirect(route('transfer.user.credit'))->with(['userData' => $this->allData]);
    }



    public function updateUserCredit(Request $request)
    {
        $this->user = PhoneListUserModel::find($request->id);
        $this->credit = Credit::where('userId', $request->id);
        $this->user->update([
            'useAbleCredit' => $request->useAbleCredit,
        ]);
        $this->credit->update([
            'useableCredit' => $request->useAbleCredit,
        ]);
        return redirect()->back()->with('message', 'Successfully updated credit!');
    }
    public function editData($id)
    {
        $this->data = PhoneList::find($id);
        //return view('admin.edit-data', ['data'=>$this->data]);
    }
    public function updateData(Request $request)
    {
        data::updatedata($request);
        return redirect('/manage-data')->with('message', 'Successfully updated data!');
    }
    public function deleteData($id)
    {
        $this->data = PhoneList::find($id);
        $this->data->delete();
        return redirect(route('view.all'))->with('message', 'Successfully deleted data!');
    }


    public function generateSiteMap()
    {
        $countries = Country::select('id', 'countryname')->get();
        $sitemap = SitemapGenerator::create('https://phonelist.io')->getSitemap();
        foreach ($countries as $key => $country) {
            $sitemap->add(Url::create("/country/{$country->countryname}"));
        }
        $sitemap->add(Url::create("/people/male"));
        $sitemap->add(Url::create("/people/female"));
        $sitemap->writeToFile(public_path('main_sitemap.xml'));


        $phone = PhoneList::select('id', 'first_name', 'last_name')->get(); //->take(56000)
        $sitemap = Sitemap::create();
        $count = 0;
        $number = 1;
        foreach ($phone as $key => $value) {
            $sitemap->add(Url::create("/people/{$value->id}/{$value->first_name}-{$value->last_name}"));

            $count += 1;
            if ($count == 10000) {
                $sitemap->writeToFile(public_path('sitemap' . $number . '.xml'));

                $sitemap = Sitemap::create();
                $count = 0;
                $number++;
            }
        }
        $sitemap->writeToFile(public_path('sitemap_last_data.xml'));

        return redirect()->back()->with('message', 'Sitemap Generated Successfully!');
    }
}
