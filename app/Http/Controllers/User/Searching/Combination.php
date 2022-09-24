<?php

namespace App\Http\Controllers\User\Searching;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Credit;
use App\Models\DownloadedList;
use App\Models\PhoneList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Str;


class Combination extends Controller
{
    protected $allData;
    protected $allDataIds;
    protected $countries;
    protected $getdownloadedId;


    public function filter_data($request)
    {
        if ($request->age != null) {
            $validated = $request->validate([
                'age' => 'required|digits:4',
            ]);
            $ages = $validated['age'];
        }

         //$query = DB::table('phone_lists')
        $query = QueryBuilder::for(PhoneList::class)
                  ->whereNotIn('id', explode(',', $this->getdownloadedId));
        // $query = PhoneList::chunk(100, function($posts, $request){
        //     foreach ($posts as $post){
        //         if ($request->name != null) {
        //             $post =  $post->where(function ($post) use ($request) {
        //             $post->where('first_name', '=', $request->name)
        //                 ->orWhere('last_name', '=', $request->name)
        //                 ->orWhere('full_name', '=', $request->name);
        //             });
        //         }
        //         if ($request->location != null) {
        //             $post =  $post->where(function ($post) use ($request) {
        //                 $post->where('location', '=', $request->location)
        //                     ->orWhere('location_city', '=', $request->location)
        //                     ->orWhere('location_city', '=', ' ' . $request->location)
        //                     ->orWhere('location_state', '=', ' ' . $request->location)
        //                     ->orWhere('location_state', '=', ' ' . $request->location . "'")
        //                     ->orWhere('location_region', '=', ' ' . $request->location);
        //             });
        //         }
        //         if ($request->hometown != null) {
        //             $post =  $post->where(function ($post) use ($request) {
        //                 $post->where('hometown', '=', $request->hometown)
        //                     ->orwhere('hometown_city', '=', $request->hometown)
        //                     ->orwhere('hometown_city', '=', ' ' . $request->hometown)
        //                     ->orWhere('hometown_state', '=', ' ' . $request->hometown)
        //                     ->orWhere('hometown_state', '=', ' ' . $request->hometown . "'")
        //                     ->orWhere('hometown_region', '=', ' ' . $request->hometown);
        //             });
        //         }
        //         if ($request->country != null) {
        //             $post =  $post->where('country', '=', $request->country);
        //         }
        //         if ($request->gender != null) {
        //             $post =  $post->where('gender', '=', $request->gender);
        //         }
        //         if ($request->relationship_status != null) {
        //             $post =  $post->where('relationship_status', '=', $request->relationship_status);
        //         }
        //         if ($request->age != null) {
        //             $post =  $post->where('age', 'like', '%/' . $ages);
        //         }
        //     }
        // });
            

        if ($request->name != null) {
            $query =  $query->where(function ($query) use ($request) {
                $query->where('first_name', '=', $request->name)
                    ->orWhere('last_name', '=', $request->name)
                    ->orWhere('full_name', '=', $request->name);
            });
        }
        if ($request->location != null) {
            $query =  $query->where(function ($query) use ($request) {
                $query->where('location', '=', $request->location)
                    ->orWhere('location_city', '=', $request->location)
                    ->orWhere('location_city', '=', ' ' . $request->location)
                    ->orWhere('location_state', '=', ' ' . $request->location)
                    ->orWhere('location_state', '=', ' ' . $request->location . "'")
                    ->orWhere('location_region', '=', ' ' . $request->location);
            });
        }
        if ($request->hometown != null) {
            $query =  $query->where(function ($query) use ($request) {
                $query->where('hometown', '=', $request->hometown)
                    ->orwhere('hometown_city', '=', $request->hometown)
                    ->orwhere('hometown_city', '=', ' ' . $request->hometown)
                    ->orWhere('hometown_state', '=', ' ' . $request->hometown)
                    ->orWhere('hometown_state', '=', ' ' . $request->hometown . "'")
                    ->orWhere('hometown_region', '=', ' ' . $request->hometown);
            });
        }
        if ($request->country != null) {
            $query =  $query->where('country', '=', $request->country);
        }
        if ($request->gender != null) {
            $query =  $query->where('gender', '=', $request->gender);
        }
        if ($request->relationship_status != null) {
            $query =  $query->where('relationship_status', '=', $request->relationship_status);
        }
        if ($request->age != null) {
            $query =  $query->where('age', 'like', '%/' . $ages);
        }

        $results = $query->orderBy('full_name', 'ASC');
        return $results;
    }


    public function peopleSearchCombination(Request $request)
    {
        $credit = Credit::where('userId', Auth::user()->id)->first();
        if ($credit->useableCredit == 0)
            return view('userDashboard.settings.upgrade');
        if ($credit->useableCredit >= 1 && $request->name != null && $request->page == null)
            Credit::filterCredit();
        if ($credit->useableCredit >= 1 && $request->location != null && $request->page == null)
            Credit::filterCredit();
        if ($credit->useableCredit >= 1 && $request->hometown != null && $request->page == null)
            Credit::filterCredit();
        if ($credit->useableCredit >= 1 && $request->country != null && $request->page == null)
            Credit::filterCredit();
        if ($credit->useableCredit >= 1 && $request->age != null && $request->page == null) {
            Credit::filterCredit();
        }
        if ($credit->useableCredit >= 1 && $request->gender != null && $request->page == null)
            Credit::filterCredit();
        if ($credit->useableCredit >= 1 && $request->relationship_status != null && $request->page == null)
            Credit::filterCredit();



        $this->countries = Country::all();
        $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds) {
            $getdownloadedIds = $getdownloadedIds . ',' . $dataIds->downloadedIds;
        }
        $this->getdownloadedId = $getdownloadedIds;

            
        if ($request->name == null && $request->location == null && $request->hometown == null
        && $request->country == null && $request->gender == null && $request->relationship_status == null
        && $request->age == null) {
            $this->countries = Country::all();
            $dataCount = QueryBuilder::for(PhoneList::class)
                ->select('id')
                ->count();
            return view('userDashboard.people', ['country' => $this->countries, 'count'=>$dataCount]);
        }
        $response_data = $this->filter_data($request);
        // $this->allData = $response_data->paginate(15);
        $this->allData = $response_data->simplePaginate(15)->withQueryString();
        $dataCount = $response_data->select('id')->count();

        if($this->allData->isEmpty())
        {
            return view('userDashboard.people', [
                'allData' => $this->allData, 'country' => $this->countries,
                'name' => $request->name, 'location' => $request->location,
                'countries' => $request->country, 'hometown' => $request->hometown,
                'gender' => $request->gender, 'relationship_status' => $request->relationship_status,
                'age' => $request->age, 'count' => $dataCount, 'message' => 'No Data Found'
            ]);
        }
            
            return view('userDashboard.people', [
                'allData' => $this->allData, 'country' => $this->countries,
                'name' => $request->name, 'location' => $request->location,
                'countries' => $request->country, 'hometown' => $request->hometown,
                'gender' => $request->gender, 'relationship_status' => $request->relationship_status,
                'age' => $request->age, 'count' => $dataCount
            ]);
        
    }
}
