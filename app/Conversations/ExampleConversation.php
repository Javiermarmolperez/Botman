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
    
    public function askReason()
    {
        $question = Question::create('¿Que quieres que haga por ti?')
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([


                Button::create('Cuéntame un chiste')->value('broma'),
                Button::create('Últimas noticias')->value('noticias'),
                Button::create('Frase del día')->value('quote'),
                Button::create('El tiempo en Barcelona')->value('tiempo'),



            ]);

        return $this->ask($question, function (Answer $answer)
        {
            if ($answer->isInteractiveMessageReply())
            {
                if ($answer->getValue() === 'broma') {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say($joke->value->joke);

                } if ($answer->getValue() === 'quote') {
                    $this->say(Inspiring::quote());
                } if ($answer->getValue() === 'noticias') {
                    $json = json_decode(file_get_contents('https://api.crhoy.net/ultimas/5.json'));
                    $this->say('<strong> <a href="'.$json->ultimas[0]->url.'" target="_blank">Noticia 1</a> </strong> <br> <br>' . $json->ultimas[0]->title);
                    $this->say('<strong> <a href="'.$json->ultimas[1]->url.'" target="_blank">Noticia 2</a> </strong> <br> <br>' . $json->ultimas[1]->title); 
                    $this->say('<strong> <a href="'.$json->ultimas[2]->url.'" target="_blank">Noticia 3</a> </strong> <br> <br>' . $json->ultimas[2]->title);
                    $this->say('<strong> <a href="'.$json->ultimas[3]->url.'" target="_blank">Noticia 4</a> </strong> <br> <br>' . $json->ultimas[3]->title);
                    $this->say('<strong> <a href="'.$json->ultimas[4]->url.'" target="_blank">Noticia 5</a> </strong> <br> <br>' . $json->ultimas[4]->title);
                    $this->say(' <strong> Para mas notícias visita  <a href="https://www.crhoy.com/" target="_blank">crhoy</a> </strong>');
                }
               
                if ($answer->getValue() === 'tiempo')
                {
                    $this->say(TiempoConversation::info());


                }
        }});
    }

  
    public function run()
    {
        $this->askReason();
    }
}
