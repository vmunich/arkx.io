<?php

namespace Tests\Feature\Http\Front\Reports;

use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function guests_can_search_reports()
    {
        $report = $this->createReport();

        $this
            ->post('/reports/search', ['search' => $report->date])
            ->assertSuccessful()
            ->assertSee($report->amount / 1e8);
    }
}
