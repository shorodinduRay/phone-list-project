<?php

namespace App\Models;

use App\Models\CreditPurchaseHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected static $credit;
    protected static $allDataIds;
    protected static $allDataIds2;
    protected $fillable = [
        'userId',
        'useableCredit'
    ];

    public static function updateUserCradit($request)
    {

        self::$allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach (self::$allDataIds as $dataIds)
        {

            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }



        $preDownloaded = (count(array_intersect($request->chk, explode(',',$getdownloadedIds ))));




        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         =  Auth::user()->id;
        self::$credit->useableCredit  = $usableCredit-count($request->chk)+$preDownloaded;
        self::$credit->save();
    }
    public static function allDataCradit($request, $array)
    {

        self::$allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach (self::$allDataIds as $dataIds)
        {

            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }



        $preDownloaded = (count(array_intersect($array, explode(',',$getdownloadedIds ))));

        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         =  Auth::user()->id;
        self::$credit->useableCredit  = $usableCredit-$request+$preDownloaded;
        self::$credit->save();
    }
    public static function updateUserCreditForOne($request)
    {

        self::$allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        self::$allDataIds2 = DownloadedList::where('userId', Auth::user()->id)->count();
        if (self::$allDataIds2 != 0)
        {
            $getdownloadedIds = 0;
            foreach (self::$allDataIds as $dataIds)
            {

                $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
            }

            $preDownloaded = (count(array_intersect($request->toArray(), explode(',',$getdownloadedIds ))));
        }
        else
        {
            $preDownloaded = 0;
        }

        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = Auth::user()->id;
        self::$credit->useableCredit  = $usableCredit-1+$preDownloaded;
        self::$credit->save();
    }
    public static function updateCredit($request)
    {
        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        $prev_credits = $usableCredit;
        self::$credit->userId         = $request->userId;
        self::$credit->useableCredit  = $usableCredit+$request->credit;
        $new_credits = self::$credit->useableCredit;
        self::$credit->save();

        CreditPurchaseHistory::createHistory($request, $prev_credits, $new_credits);
    }
    public static function updateCreditByBTC($request)
    {
        self::$credit = Credit::where('userId', $request->userId)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = $request->userId;
        self::$credit->useableCredit  = $usableCredit+$request->credit;
        self::$credit->save();
    }
    public static function updateCreditByAdmin($request, $id)
    {
        self::$credit = Credit::where('userId',$id)->first();
        $usableCredit = self::$credit->useableCredit;
        $prev_credits = $usableCredit;
        self::$credit->userId         = $id;
        self::$credit->useableCredit  = $usableCredit+$request->credit;
        $new_credits = self::$credit->useableCredit;
        self::$credit->save();

        CreditPurchaseHistory::updateCreditByAdmin($request, $prev_credits, $new_credits, $id);
    }

    public static function filterCredit()
    {
        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId = Auth::user()->id;
        self::$credit->useableCredit = $usableCredit - 1;
        self::$credit->save();

        $user = PhoneListUserModel::find(Auth::user()->id);
        $user->update([
            'useAbleCredit' => self::$credit->useableCredit,
        ]);
    }

    public static function errorCredit()
    {
        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId = Auth::user()->id;
        self::$credit->useableCredit = 0;
        self::$credit->save();

        $user = PhoneListUserModel::find(Auth::user()->id);
        $user->update([
            'useAbleCredit' => 0,
        ]);
    }




}
