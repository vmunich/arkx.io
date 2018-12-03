<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\View\View
     */
    public function home(): View
    {
        return view('front.home');
    }

    /**
     * Show the proposal page.
     *
     * @return \Illuminate\View\View
     */
    public function proposal(): View
    {
        return view('front.proposal');
    }

    /**
     * Show the contributions page.
     *
     * @return \Illuminate\View\View
     */
    public function contributions(): View
    {
        return view('front.contributions');
    }
}
