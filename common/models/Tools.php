<?php

namespace common\models;

use Yii;

class Tools
{
    static function wordcut($string, $cutlength = 250, $replace = '...'){ 
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

    static public function getMostPopularTours()
    {
        $tours = [];
        if (($mp_theme = \common\models\Theme::find()->where(['id' => TOUR_THEMES_MOST_POPULAR])->One()) !== null)
        {
            if (!empty($mp_theme['use_ids'])) {
                $tour_ids = explode(',', $mp_theme['use_ids']);
                $condition = array();
                $condition['status'] = DIS_STATUS_SHOW;
                $condition['id'] = $tour_ids;
                $query = \common\models\Tour::find()->where($condition);
                $tours = $query
                ->orderBy([new \yii\db\Expression('FIELD (id, ' . implode(',', $tour_ids) . ')')])
                ->limit(6)
                ->all();
            }
        }
        return $tours;
    }
}
