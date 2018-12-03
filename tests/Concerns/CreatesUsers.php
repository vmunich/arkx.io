<?php

namespace Tests\Concerns;

use App\Models\Announcement;
use App\Models\Block;
use App\Models\Disbursement;
use App\Models\Report;
use App\Models\User;
use App\Models\Wallet;

trait CreatesUsers
{
    public function createBlock(array $overrides = []): Block
    {
        return factory(Block::class)->create($overrides);
    }

    public function createReport(array $overrides = []): Report
    {
        return factory(Report::class)->create($overrides);
    }

    public function createDisbursement(array $overrides = []): Disbursement
    {
        return factory(Disbursement::class)->create($overrides);
    }

    public function createAnnouncement(array $overrides = []): Announcement
    {
        return factory(Announcement::class)->create($overrides);
    }

    public function createWallet(array $overrides = []): Wallet
    {
        return factory(Wallet::class)->create($overrides);
    }

    public function createUser(array $overrides = []): User
    {
        return factory(User::class)->create($overrides);
    }

    public function createAdministrator(array $overrides = []): User
    {
        return $this->createUser($overrides)->assignRole('admin');
    }

    public function createVoter(array $overrides = []): User
    {
        return $this->createUser($overrides)->assignRole('voter');
    }
}
