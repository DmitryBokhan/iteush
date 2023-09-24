<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('reg_menu_commands', function () {

    /** @var \DefStudio\Telegraph\Models\TelegraphBot $bot */
    $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
    dump($bot->url()); //получим URL бота
    dump($bot->info()); // получим подробную информацию о боте


    //так мы регистрируем команды меню бота
    /** @var \DefStudio\Telegraph\Models\TelegraphBot $bot */
    $bot->registerCommands([
        'curs' => 'Текущий курс $',
        'hello' => 'Поздоровается с вами',
        'actions' => 'Действия',
    ])->send();

})->purpose('Зарегистрировать команды меню бота');
