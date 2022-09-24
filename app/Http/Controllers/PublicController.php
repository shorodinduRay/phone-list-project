<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\PhoneList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;
use App\CustomClasses\ColectionPaginate;
use Illuminate\Pagination\LengthAwarePaginator;

class PublicController extends Controller
{
    protected $data;
    protected $userData;
    protected $countries;
    public function index()
    {
        return view('front.dashboard');
    }
    public function home()
    {
        // $query = Phonelist::select('id');

        // $phoneCount = $query->count();
        // $phoneLocation = $query->where('location', '!=', '')->count();

        return view('front.home'/*, ['rowcount' => $phoneCount, 'rowcount2' => $phoneLocation]*/);
    }
    public function category($id)
    {
        // $data = DB::table('phone_lists')->where('first_name', 'like', $x.'%')->paginate(200);

        $countries = Country::all();
        $data = PhoneList::where('first_name', 'like', $id . '%')->simplePaginate(200)->withQueryString();
        return view('front.category', ['data' => $data, 'country' => $countries])->with('dataId', $id);
    }
    public function user($id)
    {
        $this->countries = Country::all();
        $this->data = Phonelist::find($id);
        $result = substr($this->data->first_name, 0, 3);
        $this->userData = PhoneList::where('full_name', 'LIKE', $result. '%'  )->take(6)->get();

        return view('front.user.user', ['data'=>$this->data, 'country' => $this->countries])->with('userData', $this->userData);
    }
    public function userSearch(Request $request)
    {
        if($request->searchPeople == null)
        {
            return redirect()->back();
        }
        $this->countries = Country::all();
        $this->data = PhoneList::where('full_name', $request->searchPeople)->first();
        if($this->data == null)
        {
            return redirect()->route('category', ['id'=> $request->searchPeople])->with('message', $request->searchPeople);
        }
        $result = substr($this->data->full_name, 0, 3);
        $this->userData = PhoneList::where('full_name', 'LIKE', $result. '%'  )->get();
        return redirect()->route('user', [ 'id'=>$this->data->id, 'name'=>$this->data->full_name]);

        //return view('front.user.user', ['data'=>$this->data, 'country' => $this->countries])->with('userData', $this->userData);
    }

    public function country($id)
    {
        $countries = Country::all();
        $data = PhoneList::where('country', 'like', $id . '%')->simplePaginate(200)->withQueryString();
        return view('front.country.country', ['data' => $data,  'country' => $countries])->with('dataId', $id);
    }


    public function sitemapFileList()
    {
        $files = File::files(public_path());
        date_default_timezone_set("Asia/Dhaka");

        $fileName = [];
        foreach ($files as $key => $file) {
            $full_name = $file->getFileName();
            $lastModified = date("Y-m-d H:i A", filemtime($file));

            $name = explode('.', $full_name);
            if (isset($name[1]) && $name[1] == 'xml') {
                $single_file = [
                    'name' => $full_name,
                    'modified' => $lastModified,
                ];

                array_push($fileName, $single_file);
            }
        }
        return view('sitemap.file-list', ['files' => $fileName]);
    }

    public function sitemapFileDetails($file_name)
    {
        date_default_timezone_set("Asia/Dhaka");
        $xmlDataString = file_get_contents(public_path($file_name));
        $xmlObject = simplexml_load_string($xmlDataString);

        $json = json_encode($xmlObject);
        $xmlFileArray = json_decode($json, true);

        // echo "<pre>"; 
        // print_r($xmlFileArray);
        // exit();

        return view('sitemap.file-details', ['fileData' => $xmlFileArray, 'file_name' => $file_name]);
    }
}
