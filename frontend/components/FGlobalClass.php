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
        parent::init();
    }
}


