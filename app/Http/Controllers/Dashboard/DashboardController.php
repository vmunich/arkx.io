<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the voter dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $wallets = auth()->user()->wallets;
        $disbursements = auth()->user()->disbursements()->take(10)->get();

        return view('dashboard.home', compact('wallets', 'disbursements'));
    }
}
