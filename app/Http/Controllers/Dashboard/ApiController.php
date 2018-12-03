<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Show the API docs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.api', [
            'token' => auth()->user()->api_token,
        ]);
    }
}
