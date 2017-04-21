<?php
namespace frontend\components;
require(dirname(__FILE__)."/../../common/models/Mobile_Detect.php");

use Yii;
use Mobile_Detect;

class FGlobalClass extends \yii\base\Component
{

    public function init()
    {
        $cookie_name_is_moible = '_is_moible';
        Yii::$app->params['is_mobile'] = 0;
        if (isset($_COOKIE[$cookie_name_is_moible])) {
            $cookie_is_mobile = $_COOKIE[$cookie_name_is_moible];
            if ($cookie_is_mobile == '1') {
                Yii::$app->params['is_mobile'] = 1;
            }
        }
        else
        {
            $Mobile_Detect = new Mobile_Detect();
            if ($Mobile_Detect->isMobile() && !$Mobile_Detect->isTablet()) {
                Yii::$app->params['is_mobile'] = 1;
            }
            setcookie($cookie_name_is_moible, Yii::$app->params['is_mobile'], time()+3600*24*365, '/');
        }

        $cookie_name_currency = '_currency';
        $currency = '';
        if (isset($_GET['currency'])) {
            $currency = $_GET['currency'];
        }
        if (!empty($currency) && array_key_exists($currency, Yii::$app->params['currency_name'])) {
            Yii::$app->params['currency'] = $currency;
            setcookie($cookie_name_currency, Yii::$app->params['currency'], time()+3600*24*365, '/');
        }
        else{
            if (!isset($_COOKIE[$cookie_name_currency])) {
                $cookie_currency = 'USD';
                setcookie($cookie_name_currency, $cookie_currency, time()+3600*24*365, '/');
            }
            else
            {
                $cookie_currency = strtoupper($_COOKIE[$cookie_name_currency]);
            }
            Yii::$app->params['currency'] = $cookie_currency;
        }

        if (!isset($_COOKIE['_language']))
        {
            //auto set language from browser
            // $supportedLanguages = Yii::$app->urlManager->languages;
            // $preferredLanguage = Yii::$app->request->getPreferredLanguage($supportedLanguages);
            // if (empty($preferredLanguage)) {
            //     $preferredLanguage = Yii::$app->sourceLanguage;
            // }
            // Yii::$app->language = $preferredLanguage;
        }

        if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'action=')===0){
            $query_string = $_SERVER['QUERY_STRING'];
            
            $url_dir = \common\models\Tools::getFormRedirectUrl('query');

            foreach ($url_dir as $key => $value) {
                if (stripos($query_string, $key) !== false) {
                    header("HTTP/1.1 301 Moved Permanently"); 
                    header("Location: ".SITE_BASE_URL."{$value}"); 
                    exit();
                }
            }

            // header("HTTP/1.1 301 Moved Permanently"); 
            // header("Location: ".SITE_BASE_URL.'/site/error');
            http_response_code(404);
            include(dirname(dirname(__DIR__)) . '/frontend/web/statics/pages/404.html');
            exit;
        }

        //temp language jump
        if(isset($_SERVER['REQUEST_URI']))
        {
            $supportedLanguages = Yii::$app->urlManager->languages;
            $url = $_SERVER['REQUEST_URI'];
            foreach ($supportedLanguages as $language) {
                $lang_path = "/{$language}/";
                if ((strpos($url, $lang_path) === 0 || "/{$language}" == $url) && $language != Yii::$app->sourceLanguage 
                    && stripos($url, 'secure-credit-card-form') === false
                    && stripos($url, 'terms-of-service') === false
                    && !YII_DEBUG
                    ) {
                    header('Location: http://'.$language.'.thechinaguide.com');
                    exit;
                }
            }

            $red_dir = \common\models\Tools::getFormRedirectUrl('uri');

            foreach ($red_dir as $key => $value) {
                if (stripos($url, $key) === 0) {
                    header("HTTP/1.1 301 Moved Permanently"); 
                    header("Location: ".SITE_BASE_URL."{$value}"); 
                    exit();
                }
            }
            if (stripos($url, 'promo-viajeros-callejeros=1') !== false) {
                header("HTTP/1.1 301 Moved Permanently"); 
                header("Location: ".SITE_BASE_URL); 
                exit();
            }

            if ($_SERVER['SERVER_NAME'] != SITE_SERVER_NAME) {
                header("HTTP/1.1 301 Moved Permanently"); 
                header("Location: ".SITE_BASE_URL.$url); 
                exit();
            }
        }


        parent::init();
    }
}


