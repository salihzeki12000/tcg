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

    static public function wordcut($str, $length = null, $start = 0)
    {

        // 先正常截取一遍.
        $res = substr($str, $start, $length);
        $strlen = strlen($str);

        /* 接着判断头尾各6字节是否完整(不残缺) */
        // 如果参数start是正数
        if ($start >= 0) {
          // 往前再截取大约6字节
          $next_start = $start + $length; // 初始位置
          $next_len = $next_start + 6 <= $strlen ? 6 : $strlen - $next_start;
          $next_segm = substr($str, $next_start, $next_len);
          // 如果第1字节就不是 完整字符的首字节, 再往后截取大约6字节
          $prev_start = $start - 6 > 0 ? $start - 6 : 0;
          $prev_segm = substr($str, $prev_start, $start - $prev_start);
        } // start是负数
        else {
          // 往前再截取大约6字节
          $next_start = $strlen + $start + $length; // 初始位置
          $next_len = $next_start + 6 <= $strlen ? 6 : $strlen - $next_start;
          $next_segm = substr($str, $next_start, $next_len);

          // 如果第1字节就不是 完整字符的首字节, 再往后截取大约6字节.
          $start = $strlen + $start;
          $prev_start = $start - 6 > 0 ? $start - 6 : 0;
          $prev_segm = substr($str, $prev_start, $start - $prev_start);
        }
        // 判断前6字节是否符合utf8规则
        if (preg_match('@^([x80-xBF]{0,5})[xC0-xFD]?@', $next_segm, $bytes)) {
          if (!empty($bytes[1])) {
            $bytes = $bytes[1];
            $res .= $bytes;
          }
        }
        // 判断后6字节是否符合utf8规则
        $ord0 = ord($res[0]);
        if (128 <= $ord0 && 191 >= $ord0) {
          // 往后截取 , 并加在res的前面.
          if (preg_match('@[xC0-xFD][x80-xBF]{0,5}$@', $prev_segm, $bytes)) {
            if (!empty($bytes[0])) {
              $bytes = $bytes[0];
              $res = $bytes . $res;
            }
          }
        }
        if (strlen($res) < $strlen) {
          $res = $res . '...';
        }
        return $res;
    }

    // static function wordcut1($string, $cutlength = 250, $replace = '...'){ 
    //     if(mb_strlen($string) <= $cutlength){ 
    //         return $string; 
    //     }
    //     else{ 

    //         $totalLength = 0; 
    //         $datas = $newwords = array(); 

    //         $wrap = wordwrap($string,1,"\t"); 

    //         $wraps = explode("\t",$wrap);
    //         foreach ($wraps as $tmp){ 

    //             $datas[$tmp] = mb_strlen($tmp); 
    //         } 
    //         foreach ($datas as $word => $length){ 

    //             $totalLength += $length; 

    //             if($totalLength < $cutlength){ 
    //             array_push($newwords,$word); 
    //             }
    //             else{ 
    //                 break; 
    //             } 
    //         } 

    //         $str = trim(implode(' ',$newwords)); 
    //         return empty($str) ? $str : $str.' '.$replace; 
    //     } 
    // }

    static function limit_words($string, $word_limit)
    {
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit));
    }

    static public function getMostPopularTours($count=6)
    {
        $cache = Yii::$app->cache;
        $cache_key = 'MOST_POPULAR_TOURS'.$count;
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            if (($mp_theme = \common\models\Theme::find()->where(['id' => TOUR_THEMES_MOST_POPULAR])->One()) !== null)
            {
                if (!empty($mp_theme['use_ids'])) {
                    $tour_ids = explode(',', $mp_theme['use_ids']);
                    $condition = array();
                    $condition['status'] = DIS_STATUS_SHOW;
                    $condition['id'] = $tour_ids;
                    $query = \common\models\Tour::find()->where($condition);
                    $data = $query
                    ->orderBy([new \yii\db\Expression('FIELD (id, ' . implode(',', $tour_ids) . ')')])
                    ->limit($count)
                    ->all();
                    $cache->set($cache_key, $data, 60*10);
                }
            }
        }
        return $data;
    }

    static public function getMostPopularBlogs($count=10)
    {
        $cache = Yii::$app->cache;
        $cache_key = 'MOST_POPULAR_BLOGS'.$count;
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            $blogs_query = \common\models\Article::find()->where(['type' => 1]);
            $data = $blogs_query
            	->andWhere(['rec_type' => 2])
                ->orderBy('priority DESC, id ASC')
                ->limit($count)
                ->all();
            $cache->set($cache_key, $data, 60*10); 
        }

        return $data;
    }

    static public function getMostPopularCities($count=6)
    {
        $cache = Yii::$app->cache;
        $cache_key = 'MOST_POPULAR_CITIES_'.$count;
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            $cities_map_query = \common\models\Cities::find()->where(['id'=>[1,2,3,5,6,7,9,10,20]]);
            $data = $cities_map_query
                ->orderBy('priority DESC, id ASC')
                ->limit($count)
                ->all();
            $cache->set($cache_key, $data, 60*10); 
        }

        return $data;
    }

    static public function getAllTheme()
    {
        $cache = Yii::$app->cache;
        $cache_key = 'ALL_THEME';
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            $themes_query = \common\models\Theme::find()->where(['status'=>DIS_STATUS_SHOW]);
            $data = $themes_query
                ->orderBy('priority DESC, id ASC')
                ->all();
            $cache->set($cache_key, $data, 60*10); 
        }
        
        return $data;
    }

    static public function getCitiesByRecType($rec_type = REC_TYPE_POPULAR)
    {
        $cache = Yii::$app->cache;
        $cache_key = 'CITIES_INFO_REC_TYPE_'.$rec_type;
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            $cities_query = \common\models\Cities::find()->select(['id','name','pic_s','pic_l','rec_type','url_id'])->where(['status'=>DIS_STATUS_SHOW]);
            $cities_query->andWhere("FIND_IN_SET('".$rec_type."', rec_type)");
            $data = $cities_query
                ->orderBy('priority DESC, id ASC')
                ->all();
            $cache->set($cache_key, $data, 60*10); 
        }

        return $data;
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
    
    static public function getFormRedirectUrl($type='query')
    {
        $cache = Yii::$app->cache;
        $cache_key = 'CONFIG_REDIRECT_URL';
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            if (($row = \common\models\EnvironmentVariables::findOne('redirect_url')) !== null) {
                $json_val = $row['value'];
                $list = json_decode($json_val, true);
                $data = [];
                foreach ($list as $key => $value) {
                    if (strpos($key, 'action') === 0) {
                        $data['query'][$key] = $value;
                    }
                    else{
                        $data['uri'][$key] = $value;
                    }
                }
                $cache->set($cache_key, $data, 60*5);
                return $data[$type];
            } else {
                return [];
            }
        }
        else{
            return $data[$type];
        }
    }

    static public function getEnvironmentVariable($var_name)
    {
        $cache = Yii::$app->cache;
        $cache_key = 'ENVIRONMENT_VARIABLE_'.strtoupper($var_name);
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            if (($row = \common\models\EnvironmentVariables::findOne($var_name)) !== null) {
                $json_val = $row['value'];
                $data = json_decode($json_val, true);
                $data = empty($data)?[]:$data;
                $cache->set($cache_key, $data, 60*5);
            }
        }
        return $data;
    }

    static public function getUserList()
    {
        $cache = Yii::$app->cache;
        $cache_key = 'ADMIN_USER_LIST';
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            $user_list = \common\models\User::find()->where(['status'=>10])->andFilterWhere(['>', 'id', 1])->orderBy('id ASC')
                ->all();
            if (!empty($user_list)) {
                foreach ($user_list as $user) {
                    $data[$user['id']] = $user['username'];
                }
                $cache->set($cache_key, $data, 60*5);
            }
        }
        return $data;
    }

    static public function getAgentUserList()
    {
        $cache = Yii::$app->cache;
        $cache_key = 'AGENT_USER_LIST';
        $data = $cache->get($cache_key);
        if (empty($data)) {
            $data = [];
            $user_list = \common\models\User::find()->where(['status'=>10])->andFilterWhere(['>', 'id', 1])->orderBy('id ASC')
                ->all();
            if (!empty($user_list)) {
                $auth = Yii::$app->authManager;
                foreach ($user_list as $user) {
                    $roles = $auth->getRolesByUser($user['id']);
                    if (isset($roles['OA-Agent']) || isset($roles['OA-Operator'])) {
                        $data[$user['id']] = $user['username'];
                    }
                }
                $cache->set($cache_key, $data, 60*5);
            }
        }
        return $data;
    }

    static public function getSubUserByUserId($userId)
    {
        $sql = "SELECT a.sub_id,b.username FROM oa_user_sub a JOIN user b ON a.sub_id=b.id WHERE a.user_id=$userId ";
        $subAgent = [];
        $subAgentList = Yii::$app->db->createCommand($sql)->queryAll();
        if (!empty($subAgentList)) {
            foreach ($subAgentList as $item) {
                $subAgent[$item['sub_id']] = $item['username'];
            }
        }
        return $subAgent;
    }

    static public function tourClosed($id)
    {
        if(!empty($id))
        {
            $query = \common\models\OaTour::find()->where(['id'=>$id]);
            $tour = $query->one();
            
            if(!empty($tour))
            { 
                return $tour['close'];
            }
            else
            {
	            return 0;
            }
        }
        else
        {
            return 0;
        }
    }

    static public function inquiryAssignedToTour($inquiry_id)
    {
        if(!empty($inquiry_id))
        {
            $query = \common\models\OaTour::find()->where(['inquiry_id'=>$inquiry_id]);
            $tour = $query->one();
            
            if(!empty($tour))
            { 
                return 1;
            }
            else
            {
	            return 0;
            }
        }
        else
        {
            return 0;
        }
    }

    static public function getTourStartDate($tour_id)
    {
        if(!empty($tour_id))
        {
            $query = \common\models\OaTour::find()->where(['id'=>$tour_id]);
            $tour = $query->one();
            
            if(!empty($tour))
            { 
                return $tour['tour_start_date'];
            }
            else
            {
	            return '';
            }
        }
        else
        {
            return '';
        }
    }
}
