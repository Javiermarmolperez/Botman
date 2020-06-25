<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('.*(Hola|buenas|buenos dias|Buenas tardes|Buenas noches).*', function ($bot) {
    $bot->reply('Hola! que necesitas?' );
});

$botman->hears('.*(necesito mas informacion|necesito una extension.*', function ($bot) {
    $bot->reply('Para mas informacion escoge una de las opciones: Departamentos, Chiste' );
});

$botman->hears('Departamentos', function ($bot) {
    $bot->reply('Vale, tenemos: Frontend, Backend, Design' );
});
$botman->fallback(function($bot) {
    $bot->reply('Perdon,no entendi...');
});
$botman->hears('Frontend', function ($bot) {
    $bot->reply('Vale, su extension es: 34 0101 0001');
});
$botman->hears('Backend', function ($bot) {
    $bot->reply('Vale, su extension es: 34 0202 0002');
});
$botman->hears('Design', function ($bot) {
    $bot->reply('Vale, su extencion es: 34 0303 0003');
});
$botman->hears('Gracias', function ($bot) {
    $bot->reply('Denada! Algo mas?');
});
$botman->hears('.*(No gracias|no|no ya esta|.*', function ($bot) {
    $bot->reply('Que tengas un buen dia!');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');