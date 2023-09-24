<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Stringable;

class Handler extends  WebhookHandler
{

    //простой ответ на команду
    public function hello(): void
    {
        // это ответ бота на команду /hello
        $this->reply('Привет! Это твой первый бот в телеграм!');
    }


    //обрабатываем ответ бота на несуществующую команду
    protected function handleUnknownCommand(Stringable $text): void
    {
        if ($text->value() == '/start') {
            $this->reply('*Привет!* Давай начнем пользоваться мной! :-)');
        } else {
            $this->reply('*Неизвестная команда*');
        }

    }


    // Принимаем текс из сообщения чата и делаем что-то. В данном случае просто отвечаем этим же текстом
    public function handleChatMessage(Stringable $text): void
    {
        $this->reply($text);
    }
}
