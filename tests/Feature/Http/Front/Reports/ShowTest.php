<?php

namespace Tests\Feature\Http\Front\Reports;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_report()
    {
        $report = $this->createReport();

        $this
            ->get("/reports/{$report->formatted_date}")
            ->assertSuccessful();
    }
}
