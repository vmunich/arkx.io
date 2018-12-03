<?php

namespace Tests\Feature\Http\Front\Blocks;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_block_list()
    {
        $this
            ->get('/blocks')
            ->assertSuccessful();
    }
}
