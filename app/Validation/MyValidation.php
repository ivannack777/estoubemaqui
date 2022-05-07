<?php

namespace App\Validation;

class MyValidation
{
    public function tags(string $tags)
    {
        if(empty($tags)) return true;
        //Verifica se as tags possuem #
        if(preg_match('/#/', $tags)){
            //separa as tags pelo #
            //array_filter para limpar vazios
            //array_map(trim) para limpar espaços
            $tagsExp = array_map('trim', array_filter(explode('#', $tags)));
            
            //percorre todos as tag para verificar 
            foreach($tagsExp as $t){
                if(preg_match('/\s/', $t)) return false;
            }
        } else {
            return false;
        }
        return true;
    }
}