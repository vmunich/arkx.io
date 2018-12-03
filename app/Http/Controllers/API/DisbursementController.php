<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Disbursement as DisbursementResource;
use App\Models\Disbursement;
use App\Repositories\DisbursementRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DisbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $disbursements = auth()->user()->disbursements()->paginate();

        return DisbursementResource::collection($disbursements);
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(Request $request, DisbursementRepository $disbursements): AnonymousResourceCollection
    {
        $disbursements = $disbursements
            ->searchByUser($request->search)
            ->paginate();

        return DisbursementResource::collection($disbursements);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Disbursement $disbursement
     *
     * @return \App\Http\Resources\Disbursement
     */
    public function show(Disbursement $disbursement): DisbursementResource
    {
        return new DisbursementResource($disbursement);
    }
}
