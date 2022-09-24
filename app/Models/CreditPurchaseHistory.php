<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditPurchaseHistory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function createHistory($request, $prev_credits, $new_credits)
    {
        CreditPurchaseHistory::create([
            'user_id' => $request->userId,
            'credit_purchase' => $request->credit,
            'previous_credit' => $request->credit,
            'new_credit' => $request->credit,
            'date' => date('Y-m-d')
        ]);
    }

    public static function updateCreditByAdmin($request, $prev_credits, $new_credits, $id)
    {
        CreditPurchaseHistory::create([
            'user_id' => $id,
            'credit_purchase' => $request->credit,
            'previous_credit' => $request->credit,
            'new_credit' => $request->credit,
            'date' => date('Y-m-d'),
            'admin_id' => auth()->user()->id,
        ]);
    }
}
