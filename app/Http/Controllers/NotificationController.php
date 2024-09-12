<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotification;

class NotificationController extends Controller
{
    // Display all notifications for admins
    public function index()
    {
        $notifications = Notification::all(); // Retrieve all notifications
        return view('admin.notifications', compact('notifications'));
    }

    // Store a new notification (optional, if manual creation is needed)
    public function store(Request $request)
    {
        $notification = new Notification();
        $notification->user_id = $request->input('user_id');
        $notification->order_id = $request->input('order_id');
        $notification->admin_id = $request->input('admin_id');
        $notification->product_title = $request->input('product_title');
        $notification->message = $request->input('message');
        $notification->save();

        return redirect()->route('admin.notifications')->with('status', 'Notification created successfully.');
    }
}
