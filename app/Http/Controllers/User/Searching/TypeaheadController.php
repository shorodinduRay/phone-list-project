<?php

namespace App\Http\Controllers\User\Searching;

use App\Exports\CustomExport;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Models\PhoneList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Output\ConsoleOutput;

class TypeaheadController extends Controller
{
    protected $data;
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        //$filterResult = PhoneList::where('full_name', 'LIKE', $query. '%')->take(10)->get();
        $filterResult = PhoneList::where('full_name', 'like', $query.'%')
                                ->orWhere('first_name', 'like', $query.'%')
                                ->orWhere('last_name', 'like', $query.'%')
                                ->take(10)
                                ->get();
        $data = array();
        foreach ($filterResult as $hsl)
        {
            $data[] = $hsl->full_name;
        }
        return response()->json($data);

    }
    public function store(Request $request)
    {
        $credit=Credit::find(Auth::user()->id);
        if ($credit->useableCredit >= 1)
        {
            ExportHistori::newExportHistoriForOne($request);
            Credit::updateUserCraditForOne($request);
            CreditHistory::createForOne($request);
            $customExport = new CustomExport($request);
            return response()->json("okay");
        }
        else
        {
            return redirect('/settings/upgrade');
        }
    }



    public function autocompletePeopleSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = PhoneList::where('name', 'LIKE', '%'.$query. '%')->take(10)->get();
        $data = array();
        foreach ($filterResult as $hsl)
        {
            $data[] = $hsl->name;
        }
        return response()->json($data);

    }

    public function autocompleteLocation(Request $request)
    {
        $query = $request->get('query');
        $filterResult = PhoneList::where('location', 'LIKE', '%'.$query. '%')->take(10)->get();
        $data = array();
        foreach ($filterResult as $hsl)
        {
            $data[] = $hsl->location;
        }
        return response()->json($data);

    }
    public function autocompleteHometown(Request $request)
    {
        $query = $request->get('query');
        $filterResult = PhoneList::where('hometown', 'LIKE', '%'.$query. '%')->take(10)->get();
        $data = array();
        foreach ($filterResult as $hsl)
        {
            $data[] = $hsl->hometown;
        }
        return response()->json($data);

    }
    public function autocompleteCountry(Request $request)
    {
        $query = $request->get('query');
        $filterResult = PhoneList::where('country', 'LIKE', $query. '%')->take(10)->get();
        $data = array();
        foreach ($filterResult as $hsl)
        {
            $data[] = $hsl->country;
        }
        return response()->json($data);

    }
}
