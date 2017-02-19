<?php

namespace common\models;

use Yii;

class Tools
{
    static public function cut_str($str, $len)
    {
        if (strlen($str) <= $len) {
            return $str;
        }
        else{
            $ret = substr($str,0, $len) . '...';
            return $ret;
        }
    }
    static public function getCurrentUrl()
    {
        $url = \yii\helpers\Url::current();
        $languages = Yii::$app->urlManager->languages;
        foreach ($languages as $language) {
            $lang_path = "/{$language}/";
            if (strpos($url, $lang_path) === 0) {
                $url = substr($url, strlen($lang_path)-1);
            }
            elseif ($url == "/{$language}") {
                $url = '/';
            }
        }
        if ($url=='/site/index') {
            $url = '/';
        }
        // var_dump($url);exit;
        return $url;
    }
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

    static public function getMostPopularTours($count=6)
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
                ->limit($count)
                ->all();
            }
        }
        return $tours;
    }

    static public function getFormPopularCities()
    {

        $cache = Yii::$app->cache;
        $cache_key = 'FORM_POPULAR_CITIES';
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $cities_query = \common\models\Cities::find()->where(['status'=>DIS_STATUS_SHOW]);
            $cities_query->andWhere("FIND_IN_SET('".REC_TYPE_POPULAR."', rec_type)");
            $cities = $cities_query
                ->orderBy('priority DESC, id ASC')
                ->all();
            if (!empty($cities)) {
                $data = [];
                foreach ($cities as $city) {
                    $data[$city['id']] = $city['name'];
                }
                $cache->set($cache_key, $data, 60*10); 
                return $data;
            }
        }
        else
        {
            return $data;
        }
    }

    static public function getFormTravelAgents()
    {
        if (($row = \common\models\EnvironmentVariables::findOne('travel_agents_mail')) !== null) {
            $json_val = $row['value'];
            $list = json_decode($json_val, true);
            $data = [];
            foreach ($list as $key => $value) {
                $data[$key] = $key;
            }
            return $data;
        } else {
            return [];
        }
    }

}
