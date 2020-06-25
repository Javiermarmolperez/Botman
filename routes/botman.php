<?php
use App\Http\Controllers\BotManController;


$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello! que quieres hacer?' );
});

$botman->hears('Hola', function ($bot) {
    $bot->reply('Hola picha!');
});

$botman->fallback(function($bot) {
    $bot->reply('Lo siento, no te entiendo');
});

$botman->hears('Cuentame algo', BotManController::class.'@startConversation');
