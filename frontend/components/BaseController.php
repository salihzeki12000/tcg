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
        Yii::$app->params['is_mobile'] = 0;
        $cookie_name_is_mobile = 'is_mobile';
        $cookie_is_mobile = Yii::$app->request->cookies->getValue($cookie_name_is_mobile);//设置默认值
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
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'is_mobile',
                'value' => Yii::$app->params['is_mobile'],
                'expire'=>time()+3600*24*365
            ]));
        }

        if (Yii::$app->controller->action->id !== 'update' || Yii::$app->user->id == $params['id']) {
            return true;
        }
        return false;
    }
}


