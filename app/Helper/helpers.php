<?php

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

//Add Notification History........
if (!function_exists('addNotification')) {
    function addNotification($title, $description, $icon)
    {
        date_default_timezone_set('Asia/Dhaka');
        $data = [
            'title' => $title,
            'description' => $description,
            'date' => date('Y-m-d'),
            'time' => date('h:i A'),
            'icon' => $icon,
            'user_id' => Auth::user()->id,
        ];

        // Insert data
        Notification::create($data);

        return true;
    }
}
