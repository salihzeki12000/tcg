<?php
namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Console;
use common\models\UploadedFiles;

class TaskController extends Controller
{    
    public function actionIndex()
    {
        var_dump(UploadedFiles::findOne(10));
        echo 'hello'. "\n";
    }
}