<?php

use Illuminate\Support\Facades\Route;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send', function () {
    \App\Jobs\SendMessageTelegram::dispatch()->onQueue('telegram_message');
});

Route::get('qr', function(){


        $url = 'https://example.com'; // Замените URL на свой
        $qrCode = QrCode::size(300)->generate($url); // Создать QR-код

        // Возвращаем представление с QR-кодом
        return view('qr_code', ['qrCode' => $qrCode]);

});

Route::get('qrcode', function () {
    // тут примеры:
    // https://www.itsolutionstuff.com/post/how-to-generate-qr-code-in-laravel-10example.html

    return QrCode::size(300)->generate('https://example.com');
});

