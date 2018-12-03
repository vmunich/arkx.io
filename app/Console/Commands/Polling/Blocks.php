<?php

namespace App\Console\Commands\Polling;

use App\Jobs\ProcessBlock;
use App\Models\Block;
use ArkX\Eloquent\Models\Block as RemoteBlock;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class Blocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:blocks {--skip-processing} {--skip-limit} {--limit=}';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $blocks = $this->getBlocks();

        foreach ($blocks as $block) {
            try {
                Block::where('block_id', $block->id)->firstOrFail();
            } catch (\Exception $e) {
                $this->line('Processing Block: <info>'.$block->id.'</info>');

                $block = Block::create([
                    'block_id'  => $block->id,
                    'height'    => $block->height,
                    'reward'    => $block->reward,
                    'forged_at' => $block->timestamp_carbon,
                ]);

                if (!$this->option('skip-processing')) {
                    ProcessBlock::dispatch($block);
                }
            }
        }
    }

    private function getBlocks(): Collection
    {
        $query = RemoteBlock::generator(config('ark.delegate.publicKey'));

        if (!$this->option('skip-limit')) {
            if ($this->option('limit')) {
                $query = $query->take($this->option('limit'));
            } else {
                $blockLocal = Block::latest()->first();
                $blockRemote = RemoteBlock::orderByDesc('height')->first();

                $heightLocal = $blockLocal ? $blockLocal->height : 0;

                $query = $query->take(abs($blockRemote->height - $heightLocal));
            }
        }

        return $query->orderByDesc('height')->get();
    }
}
