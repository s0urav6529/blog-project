<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //

    final public function userWiseNotifications()
    {
        $notifications = (new Notification())->notificationList(Auth::id());
        return response()->json($notifications);
    }
}
