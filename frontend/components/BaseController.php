<?php
namespace frontend\components;
require(dirname(__FILE__)."/../../common/models/Mobile_Detect.php");

use yii\web\Controller;
use Yii;
use Mobile_Detect;

class BaseController extends Controller
{

    public function beforeAction($action)
    {
        $cookies = Yii::$app->response->cookies;
        Yii::$app->params['is_mobile'] = 0;
        $cookie_name_is_mobile = 'is_mobile';
        $cookie_is_mobile = Yii::$app->request->cookies->getValue($cookie_name_is_mobile);
        if (isset($cookie_is_mobile)) {
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
            $cookies->add(new \yii\web\Cookie([
                'name' => 'is_mobile',
                'value' => Yii::$app->params['is_mobile'],
                'expire'=>time()+3600*24*365
            ]));
        }

        $cookie_name_currency = 'currency';
        $currency = strtoupper(trim(Yii::$app->request->get('currency')));
        if (!empty($currency) && array_key_exists($currency, Yii::$app->params['currency_name'])) {
            Yii::$app->params['currency'] = $currency;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'currency',
                'value' => Yii::$app->params['currency'],
                'expire'=>time()+3600*24*365
            ]));
        }
        else{
            $cookie_currency = Yii::$app->request->cookies->getValue($cookie_name_currency);
            if (empty($cookie_currency)) {
                $cookie_currency = 'USD';
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'currency',
                    'value' => $cookie_currency,
                    'expire'=>time()+3600*24*365
                ]));
            }
            Yii::$app->params['currency'] = $cookie_currency;
        }

        return true;
    }
}


