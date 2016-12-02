<?php
namespace backend\components;

use Yii;

class UserRule extends \yii\rbac\Rule
{

    public function execute($user, $item, $params)
    {
        // if (Yii::$app->controller->action->id !== 'update' || Yii::$app->user->id == $params['id']) {
        //     return true;
        // }
        // return false;
        return true;
    }
}


