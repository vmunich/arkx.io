<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $notifications = auth()->user()->notifications()->simplePaginate(5);

        return view('dashboard.notifications', compact('notifications'));
    }

    /**
     * Display a listing of the resource with an read state.
     *
     * @return \Illuminate\View\View
     */
    public function read(): View
    {
        $notifications = auth()->user()->readNotifications()->simplePaginate(5);

        return view('dashboard.notifications', compact('notifications'));
    }

    /**
     * Display a listing of the resource with an unread state.
     *
     * @return \Illuminate\View\View
     */
    public function unread(): View
    {
        $notifications = auth()->user()->unreadNotifications()->simplePaginate(5);

        return view('dashboard.notifications', compact('notifications'));
    }

    /**
     * Mark the specified resource as read.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function markAsRead(Request $request, string $notification): Response
    {
        $request->user()->notifications()->findOrFail($notification)->markAsRead();

        return response(null, 204);
    }
}
