<?php
use App\Http\Controllers\BotManController;


$botman = resolve('botman');

$botman->hears('.*(Hola|buenas|buenos días|Buenas tardes|Buenas noches).*', function ($bot) {
    $bot->reply('Hola! ¿Qué necesitas?' );
});

$botman->hears('.*(necesito mas información|necesito una extensión).*', function ($bot) {
    $bot->reply('Para mas información escoge una de las opciones: Departamentos, Chiste' );
});

$botman->hears('Departamentos', function ($bot) {
    $bot->reply('Vale, tenemos: Frontend, Backend, Design' );
});
$botman->fallback(function($bot) {
    $bot->reply('Perdón,no entendí...');
});
$botman->hears('Frontend', function ($bot) {
    $bot->reply('Vale, su extension es: 34 0101 0001');
});
$botman->hears('Backend', function ($bot) {
    $bot->reply('Vale, su extension es: 34 0202 0002');
});
$botman->hears('Design', function ($bot) {
    $bot->reply('Vale, su extension es: 34 0303 0003');
});
$botman->hears('Gracias', function ($bot) {
    $bot->reply('De nada! Algo mas?');
});
$botman->hears('.*(No gracias|no|no ya esta).*', function ($bot) {
    $bot->reply('Que tengas un buen dia!');
});


$botman->hears('.*(menu|ver el menu).*', BotManController::class.'@startConversation');



