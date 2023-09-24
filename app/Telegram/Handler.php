<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;
use GuzzleHttp\Client;

class Handler extends WebhookHandler
{

    //простой ответ на команду
    public function hello(): void
    {
        // это ответ бота на команду /hello
        $this->reply('Привет! Это твой первый бот в телеграм!');
    }


    //Пример получения курса доллара через команду curs меню бота
    public function curs(): void
    {
        $apiUrl = 'https://www.cbr-xml-daily.ru/daily_json.js';

        $client = new Client();

        // Отправляем GET-запрос к API для получения данных о курсе
        $response = $client->get($apiUrl);

        // Декодируем JSON-ответ в массив данных
        $data = json_decode($response->getBody(), true);

        // Извлекаем курс доллара к рублю (USD к RUB)
        $usdToRubRate = $data['Valute']['USD']['Value'];

        // Создаем сообщение для отправки в Telegram
        $message = "Курс доллара к рублю: 1 USD = $usdToRubRate RUB";

        $this->reply($message);
    }

    //простой ответ на команду
    public function start(): void
    {
        $this->reply('*Привет!* Давай начнем пользоваться мной! :-)');
    }


    //обрабатываем ответ бота на несуществующую команду
    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->reply('*Неизвестная команда*');

    }


    // Принимаем текс из сообщения чата и делаем что-то. В данном случае просто отвечаем этим же текстом
    public function handleChatMessage(Stringable $text): void
    {
        //$this->reply($text);

        //так можно получить доступ к картинкам или файлам которые отправляет пользователь
        //Log::info(json_encode($this->message->toArray(), JSON_UNESCAPED_UNICODE)); // для примера положи данные в лог файл
        // $this->message->text();
        // $this->message->document();

    }
}
