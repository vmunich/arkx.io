<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $announcements = Announcement::simplePaginate(5);

        return view('front.announcements.index', compact('announcements'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request, AnnouncementRepository $announcements): View
    {
        try {
            $announcements = $announcements
                ->search($request->search)
                ->simplePaginate(5);

            return view('front.announcements.index', compact('announcements'));
        } catch (\Exception $e) {
            alert()->info("We couldn't find any announcements for the specified term.");

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Announcement $announcement
     *
     * @return \Illuminate\View\View
     */
    public function show(Announcement $announcement): View
    {
        return view('front.announcements.show', compact('announcement'));
    }
}
