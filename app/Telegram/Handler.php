<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class Handler extends  WebhookHandler
{
    public function hello(): void
    {
        $this->reply('Привет! Это твой первый бот в телеграм!');
    }
}
