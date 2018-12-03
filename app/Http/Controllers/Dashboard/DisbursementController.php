<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\DisbursementsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Disbursement;
use App\Repositories\DisbursementRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DisbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $disbursements = auth()->user()->disbursements()->simplePaginate();

        return view('dashboard.disbursements.index', compact('disbursements'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request, DisbursementRepository $disbursements): View
    {
        $disbursements = $disbursements
            ->searchByUser($request->search)
            ->simplePaginate();

        return view('dashboard.disbursements.index', compact('disbursements'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Disbursement $disbursement
     *
     * @return \Illuminate\View\View
     */
    public function show(Disbursement $disbursement): View
    {
        $this->authorize('view', $disbursement);

        return view('dashboard.disbursements.show', compact('disbursement'));
    }

    /**
     * Export the specified wallets.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Exports\DisbursementsExport
     */
    public function export(Request $request): DisbursementsExport
    {
        return new DisbursementsExport($request->user());
    }
}
