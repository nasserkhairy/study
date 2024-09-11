<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\InvitationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user, private string $ip)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // http 
        Notification::send($this->user, new InvitationNotification($this->ip));
    }
}
