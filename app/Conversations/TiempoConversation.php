<?php

namespace App\Conversations;
use Illuminate\Support\Collection;


class TiempoConversation
{
    public static function info()
    {
       $request = json_decode(file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=Barcelona,es&APPID=7b252ea00ab6446769a0a3118960395c&lang=es'));

       $name = $request->name;
       $weather = $request->weather[0]->description;
       $temp = $request->main->temp;
       $celsius = $temp - 273;

       return "El tiempo en $name es $celsius ºC con $weather";

    }


}
