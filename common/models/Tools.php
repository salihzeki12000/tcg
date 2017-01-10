<?php

namespace common\models;

use Yii;

class Tools
{
    static function wordcut($string, $cutlength = 250, $replace = '…'){ 
        if(mb_strlen($string) <= $cutlength){ 
            return $string; 
        }
        else{ 

            $totalLength = 0; 
            $datas = $newwords = array(); 

            $wrap = wordwrap($string,1,"\t"); 

            $wraps = explode("\t",$wrap);
            foreach ($wraps as $tmp){ 

                $datas[$tmp] = mb_strlen($tmp); 
            } 
            foreach ($datas as $word => $length){ 

                $totalLength += $length; 

                if($totalLength < $cutlength){ 
                array_push($newwords,$word); 
                }
                else{ 
                    break; 
                } 
            } 

            $str = trim(implode(' ',$newwords)); 
            return empty($str) ? $str : $str.' '.$replace; 
        } 
    }

    static function limit_words($string, $word_limit)
    {
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit));
    }

}
