<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function all()
    {
        $raw =  auth()->user()->notifications;
        // return $raw;
        $notifications = $raw->map(function ($item) {
            return [
                'id' => $item->id,
                'data' => $item->data,
                'created_at' => $item->created_at->diffForHumans(),
                'read_at' => $item->read_at ?? null
            ];
        });
        return $notifications;
    }

    public function markasread($id)
    {
        if ($id) {
            auth()->user()->notifications->where('id', $id)->markAsRead();
        }

        return true;
    }

    public function markallasread()
    {

        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return true;
    }

    public function hasUnread()
    {
        if (auth()->user()) {
            if (auth()->user()->unreadNotifications->count()) {
                return response()->json(['message' => 'has unread']);
            }
        }
        return response()->json(['error' => 'no unread']);
    }

    public function hasNotifications()
    {
        if (auth()->user()) {
            if (auth()->user()->notifications->count() > 0) {
                return response()->json(['message' => 'has notifications']);
            }
        }
        return response()->json(['error' => 'no notifications']);
    }

    public function countNotifications()
    {
        if (auth()->user()) {
            return response()->json(['count' => auth()->user()->unreadNotifications->count()]);
        }
        return false;
    }
}
