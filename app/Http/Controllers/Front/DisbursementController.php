<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Disbursement;
use App\Repositories\DisbursementRepository;
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
        $disbursements = Disbursement::simplePaginate();

        return view('front.disbursements.index', compact('disbursements'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request, DisbursementRepository $disbursements): View
    {
        try {
            $disbursements = $disbursements
                ->searchAll($request->search)
                ->simplePaginate();

            return view('front.disbursements.index', compact('disbursements'));
        } catch (\Exception $e) {
            alert()->info("We couldn't find any disbursements for the specified term.");

            return back();
        }
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
        return view('front.disbursements.show', compact('disbursement'));
    }
}
