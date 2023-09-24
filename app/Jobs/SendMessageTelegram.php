<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use DefStudio\Telegraph\Models\TelegraphChat;

class SendMessageTelegram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $chat = TelegraphChat::find(1);

        // this will use the default parsing method set in config/telegraph.php
        $chat->message('Это сообщение из очереди')->send();
        sleep(5);
        $chat->html("<b>Это сообщение из очереди</b>\n\nI'm a bot!")->send();
        sleep(5);
        $chat->markdown('*Это сообщение из очереди*')->send();

    }
}
