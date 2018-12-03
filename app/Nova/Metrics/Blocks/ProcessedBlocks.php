<?php

namespace App\Nova\Metrics\Blocks;

use App\Models\Block;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class ProcessedBlocks extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->result([
            'Processed'     => Block::processed()->count(),
            'Not Processed' => Block::notProcessed()->count(),
        ]);
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'processed-blocks';
    }
}
