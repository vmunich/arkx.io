<?php

namespace Tests\Feature\Http\Front\Blocks;

use App\Models\Block;
use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function administrators_can_search_blocks()
    {
        $block = factory(Block::class)->create();

        $this
            ->post('/blocks/search', ['search' => $block->height])
            ->assertSuccessful()
            ->assertSee($block->height);
    }
}
