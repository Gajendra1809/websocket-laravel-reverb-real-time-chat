<?php

namespace App\Jobs;

use App\Events\GotMessage;
use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendMessage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Message $message)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        GotMessage::dispatch([
            'id' => $this->message->id,
            'text' => $this->message->text,
            'sender_id' => $this->message->sender_id,
            'receiver_id' => $this->message->receiver_id,
            'time' => $this->message->time
        ]);
    }
}
