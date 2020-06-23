<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello! que quieres hacer?' );
});

$botman->hears('Hola', function ($bot) {
    $bot->reply('Hola picha!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
