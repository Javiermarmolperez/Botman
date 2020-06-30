<?php

namespace Tests\BotMan;

use Illuminate\Foundation\Inspiring;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->bot
            ->receives('Hi')
            ->assertReply('Hello! que quieres hacer?');
    }

    /**
     * A conversation test example.
     *
     * @return void
     */
    public function testConversationBasicTest()
    {
        $quotes = [
            "Las mejores cosas de la vida te deshacen el pelo",
            "No soy vago, estoy en modo ahorro de energía",
            "Lo malo no es vivir en las nubes, sino bajar",
            "Odio ser bipolar, es una sensación fantástica",
            "Previsión del tiempo para esta noche: estará oscuro",
            "Las cuatro palabras más bonitas de nuestro idioma: ya te lo dije",
            "Lo más cerca que una persona llega a la perfección es el día que rellena una solicitud de empleo",
            "Un día sin sol es, ya sabes, de noche",
            "No renuncies a tus sueños... Sigue durmiendo",
            "El tiempo sin ti es empo"
        ];

        $this->bot
            ->receives('Cuentame algo')
            ->assertQuestion('¿Que quieres que haga por ti?')
            ->receivesInteractiveMessage('quote')
            ->assertReplyIn($quotes);
    }
}
