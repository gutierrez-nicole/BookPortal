<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::recent()->paginate(20);
        return response()->json($notifications);
    }

    public function unreadCount()
    {
        $count = Notification::unread()->count();
        return response()->json(['count' => $count]);
    }

    public function markAsRead(Request $request, Notification $notification)
    {
        $notification->markAsRead();
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Notification::unread()->update([
            'read' => true,
            'read_at' => now(),
        ]);
        return response()->json(['success' => true]);
    }
}
