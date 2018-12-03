<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MetricsController extends Controller
{
    /**
     * Show the metrics dashboard.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $type
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, string $type = 'week'): View
    {
        $chart = 'App\\Metrics\\Charts\\'.title_case($type);

        $disbursements = $chart::create($request->user()->disbursements());

        return view('dashboard.metrics', compact('type') + [
            'labels' => $disbursements->keys(),
            'data'   => $disbursements->values(),
        ]);
    }
}
