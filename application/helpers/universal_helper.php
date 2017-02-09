<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('removetime')){
   function removetime($date){
    $date=explode(" ",standard_date("DATE_RFC850",$date));
    return $date[0]." ".$date[1];
   }
}