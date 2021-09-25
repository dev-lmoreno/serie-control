<?php

namespace App\Listeners;

use App\Events\deleteSerie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class deleteCoverSerie implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  deleteSerie  $event
     * @return void
     */
    public function handle(deleteSerie $event)
    {   
        $serie = $event->serie;
        if ($serie->cover) {
            Storage::delete($serie->cover);
        }
    }
}
