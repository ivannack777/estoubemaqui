<?php 
namespace App;

class Dates
{
 public static function format($dateISO, String $format)
 {
    try{
        if(is_string($dateISO)){
            $date = new \DateTime($dateISO);
            return $date->format($format);
        } else {
            return null;
        }
    } catch(Exception $e){
        echo $e->getMessage();
    }
    return false;
 }
} 