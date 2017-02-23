<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class FilesController extends Controller
{    
    public function actionIndex()
    {
        $server_dir = Yii::getAlias('@uploads');
        $rows = \common\models\UploadedFiles::find()->all();
        foreach ($rows as $row) {
            $path = $server_dir.'/'.$row->path;
            if (file_exists($path)) {
                var_dump($path);
                $md5file = md5_file($path);
                var_dump($md5file);
                $row->md5 = $md5file;
                $row->save();
            }
            else{
                $row->status=0;
                $row->save();
                echo "empty file: " . $path . "\n\n";
            }
        }
        
        echo "sync task end:" . date('Y-m-d H:i:s',time()) . "\n\n\n";
    }
}