<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadedList extends Model
{
    use HasFactory;
    protected static $lists;
    protected static $list;
    protected $fillable = [
        'userId',
        'downloadedIds',
    ];
    public static function createNew($request)
    {
        self::$list = new DownloadedList();
        self::$list->userId         = Auth::user()->id;
        self::$list->downloadedIds         = implode(',',$request->chk) ;
        self::$list->save();
    }
    public static function createAllNew($request)
    {
        self::$list = new DownloadedList();
        self::$list->userId         = Auth::user()->id;
        self::$list->downloadedIds         = implode(',',$request->toArray()) ;
        self::$list->save();
    }
    public static function createForOne($request)
    {
        self::$list = new DownloadedList();
        self::$list->userId         = Auth::user()->id;
        self::$list->downloadedIds  = $request->id;
        self::$list->save();
    }
    public static function deleteUser($id){
        self::$lists = DownloadedList::where('userId', $id)->get();
        foreach(self::$lists as self::$list)
        {
            self::$list->delete();
        }
    }
}
