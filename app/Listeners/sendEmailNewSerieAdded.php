<?php

namespace App\Listeners;

use App\Events\NewSerie;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendEmailNewSerieAdded implements ShouldQueue
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
     * @param  NewSerie  $event
     * @return void
     */
    public function handle(NewSerie $event)
    {
        $users = User::all();

        foreach ($users as $index => $user) {
            $email =  new \App\Mail\NewSerie(
                $event->name,
                $event->qntTemp, 
                $event->qntEp
            );
            
            $email->subject = 'Added New Serie';
            $when = now()->addSecond(($index + 1) * 10); // valor do job na fila * 5 para dar a quantidade de delay
            // adicionando email na fila para ser processado
            Mail::to($user)->later($when, $email);
        } 
    }
}
