<?php

namespace App\Observers;

use App\Models\Board;

class BoardObserver
{
    /**
     * Handle the board "created" event.
     *
     * @param  Board  $board
     * @return void
     */
    public function created(Board $board)
    {
        //
    }

    /**
     * Handle the board "updated" event.
     *
     * @param  Board  $board
     * @return void
     */
    public function updated(Board $board)
    {
        //
    }

    /**
     * Handle the board "deleted" event.
     *
     * @param  Board  $board
     * @return void
     */
    public function deleted(Board $board)
    {
        //
    }

    /**
     * Handle the board "restored" event.
     *
     * @param  Board  $board
     * @return void
     */
    public function restored(Board $board)
    {
        //
    }

    /**
     * Handle the board "force deleted" event.
     *
     * @param  Board  $board
     * @return void
     */
    public function forceDeleted(Board $board)
    {
        //
    }
}
