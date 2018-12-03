<?php

namespace Tests\Feature\Http\Front\Blocks;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_block()
    {
        $block = $this->createBlock();

        $this
            ->get("/blocks/{$block->id}")
            ->assertSuccessful();
    }
}
