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

        $notifications = Notification::with('user', 'post')->where('post_owner', Auth::id())->latest()->get();

        return response()->json($notifications);
    }
}
