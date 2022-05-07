<?php 
namespace App;

class Dates
{
 public static function format($dateISO, String $format, $timezone=null)
 {
    try{
        if(is_string($dateISO)){
            $date = new \DateTime($dateISO, new \DateTimezone('UTC'));
            if($timezone) $date->setTimezone(new \DateTimezone($timezone));
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