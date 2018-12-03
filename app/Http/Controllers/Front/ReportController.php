<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Report;
use App\Repositories\ReportRepository;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $reports = Report::orderBy('date', 'DESC')->simplePaginate();

        return view('front.reports.index', compact('reports'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request, ReportRepository $reports): View
    {
        try {
            $reports = $reports
                ->search($request->search)
                ->simplePaginate();

            return view('front.reports.index', compact('reports'));
        } catch (\Exception $e) {
            alert()->info("We couldn't find any reports for the specified term.");

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Report $report
     *
     * @return \Illuminate\View\View
     */
    public function show(Report $report): View
    {
        $disbursements = $report->disbursements()->simplePaginate();

        return view('front.reports.show', compact('report', 'disbursements'));
    }
}
