<?php

namespace App\Observers;

use App\Models\Vote;
use Illuminate\Support\Str;

class VoteObserver
{
    /**
     * Handle the Vote "created" event.
     */
    public function creating(Vote $vote): void
    {
        $vote->uuid = Str::uuid();
    }

    /**
     * Handle the Vote "updated" event.
     */
    public function updated(Vote $vote): void
    {
        //
    }

    /**
     * Handle the Vote "deleted" event.
     */
    public function deleted(Vote $vote): void
    {
        //
    }

    /**
     * Handle the Vote "restored" event.
     */
    public function restored(Vote $vote): void
    {
        //
    }

    /**
     * Handle the Vote "force deleted" event.
     */
    public function forceDeleted(Vote $vote): void
    {
        //
    }
}
