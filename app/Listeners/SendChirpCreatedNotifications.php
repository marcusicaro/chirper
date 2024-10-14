<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ChirpCreated;
use App\Models\Chirp;
use App\Notifications\NewChirp;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendChirpCreatedNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Dispatchable, Queueable, SerializesModels;

    public Chirp $chirp;

    /**
     * Create the event listener.
     */
    public function __construct(Chirp $chirp)
    {
        $this->chirp = $chirp;
    }

    /**
     * Handle the event.
     */
    public function handle(): void
    {
        Log::info('SendChirpCreatedNotifications handle method triggered.');
        foreach (User::whereNot('id', $this->chirp->user_id)->cursor() as $user) {
            $user->notify(new NewChirp($this->chirp));
        }
    }
}