<?php

namespace Tests\Feature\Http\Front\Reports;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_report_list()
    {
        $this
            ->get('/reports')
            ->assertSuccessful();
    }
}
