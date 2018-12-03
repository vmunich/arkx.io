<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $heartbeats = config('heartbeats');

        $schedule
            ->command('ark:maintain:wallets')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:maintain:wallets']);

        $schedule
            ->command('ark:maintain:voters')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:maintain:voters']);

        $schedule
            ->command('ark:poll:prices')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:poll:prices']);

        $schedule
            ->command('ark:poll:delegate')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:poll:delegate']);

        $schedule
            ->command('ark:poll:voters')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:poll:voters']);

        $schedule
            ->command('ark:poll:blocks')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:poll:blocks']);

        $schedule
            ->command('ark:poll:transactions')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:poll:transactions']);

        $schedule
            ->command('ark:disburse:jobs')
            ->daily()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:disburse:jobs']);

        if (config('ark.share.enabled')) {
            $schedule
                ->command('ark:disburse:voters --frequency=daily')
                ->daily()
                ->withoutOverlapping()
                ->thenPing($heartbeats['ark:disburse:voters --frequency=daily']);

            $schedule
                ->command('ark:disburse:voters --frequency=weekly')
                ->weekly()
                ->withoutOverlapping()
                ->thenPing($heartbeats['ark:disburse:voters --frequency=weekly']);

            $schedule
                ->command('ark:disburse:voters --frequency=monthly')
                ->monthly()
                ->withoutOverlapping()
                ->thenPing($heartbeats['ark:disburse:voters --frequency=monthly']);

            $schedule
                ->command('ark:disburse:voters --frequency=quarterly')
                ->quarterly()
                ->withoutOverlapping()
                ->thenPing($heartbeats['ark:disburse:voters --frequency=quarterly']);

            $schedule
                ->command('ark:disburse:voters --frequency=yearly')
                ->yearly()
                ->withoutOverlapping()
                ->thenPing($heartbeats['ark:disburse:voters --frequency=yearly']);
        }

        $schedule
            ->command('ark:broadcast:disbursements --unconfirmed')
            ->everyFifteenMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:broadcast:disbursements --unconfirmed']);

        $schedule
            ->command('ark:poll:confirmations')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:poll:confirmations']);

        $schedule
            ->command('ark:generate:reports')
            ->twiceDaily(1, 13)
            ->withoutOverlapping()
            ->thenPing($heartbeats['ark:generate:reports']);

        $schedule
            ->command('backup:clean')
            ->daily()
            ->thenPing($heartbeats['backup:clean']);

        $schedule
            ->command('backup:run')
            ->daily()
            ->thenPing($heartbeats['backup:run']);

        $schedule
            ->command('backup:monitor')
            ->daily()
            ->thenPing($heartbeats['backup:monitor']);

        $schedule
            ->command('telescope:prune')
            ->daily()
            ->thenPing($heartbeats['telescope:prune']);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
