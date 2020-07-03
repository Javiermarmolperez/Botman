<?php

namespace App\Conversations;

use App\Conversations\TiempoConversation;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;


class ExampleConversation extends Conversation
{
    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create("¿Que quieres que haga por ti?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Cuéntame un chiste')->value('broma'),
                Button::create('Últimas noticias')->value('noticias'),
                Button::create('Frase del día')->value('quote'),
                Button::create('El tiempo')->value('tiempo'),

            ]);

        return $this->ask($question, function (Answer $answer)
        {
            if ($answer->isInteractiveMessageReply())
            {
                if ($answer->getValue() === 'broma') {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say($joke->value->joke);
                }
                if ($answer->getValue() === 'noticias')
                {
                    $ultimas = json_decode(file_get_contents('https://api.crhoy.net/ultimas/5.json'));
                    $this->say($ultimas->ultimas[0]->title);
                }
                if ($answer->getValue() === 'quote')
                    {
                    $this->say(Inspiring::quote());
                    }
                if ($answer->getValue() === 'tiempo')
                {
                    $this->say(TiempoConversation::info());

                }
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
