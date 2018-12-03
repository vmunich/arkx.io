<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Block;
use App\Repositories\BlockRepository;
use Illuminate\View\View;

class BlockController extends Controller
{
    /**
     * Display a listing of the blocks.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $blocks = Block::orderByDesc('height')->simplePaginate();

        return view('front.blocks.index', compact('blocks'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request, BlockRepository $blocks): View
    {
        try {
            $blocks = $blocks
                ->search($request->search)
                ->simplePaginate();

            return view('front.blocks.index', compact('blocks'));
        } catch (\Exception $e) {
            alert()->info("We couldn't find any blocks for the specified term.");

            return back();
        }
    }

    /**
     * Display the specified block.
     *
     * @param \App\Models\Block $block
     *
     * @return \Illuminate\View\View
     */
    public function show(Block $block): View
    {
        return view('front.blocks.show', compact('block'));
    }
}
