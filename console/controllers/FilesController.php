<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class FilesController extends Controller
{    
    public function actionIndex()
    {
        // $server_dir = Yii::getAlias('@uploads');
        // $rows = \common\models\UploadedFiles::find()->all();
        // foreach ($rows as $row) {
        //     $path = $server_dir.'/'.$row->path;
        //     if (file_exists($path)) {
        //         var_dump($path);
        //         $md5file = md5_file($path);
        //         var_dump($md5file);
        //         $row->md5 = $md5file;
        //         $row->save();
        //     }
        //     else{
        //         $row->status=0;
        //         $row->save();
        //         echo "empty file: " . $path . "\n\n";
        //     }
        // }
        $sql = "SELECT min(id) as id,md5,COUNT(1) as ccount FROM uploaded_files where md5<>'' GROUP BY md5 having ccount>1 ORDER BY ccount DESC;";
        $md5_data = Yii::$app->db->createCommand($sql)
        ->queryAll();
        foreach ($md5_data as $item) {
            $one_file = \common\models\UploadedFiles::findOne($item['id']);
            $files = \common\models\UploadedFiles::find()->where(['md5'=>$item['md5']])->all();
            foreach ($files as $file) {
                if ($one_file->path == $file->path) {
                    continue;
                }
                $path = $file->path;
                $file->path = $one_file->path;
                $file->save();
                $data = [$file->id, $path, $item['md5'], $one_file->path];
                echo join("\t", $data) . "\n";
            }
        }
        
        echo "sync task end:" . date('Y-m-d H:i:s',time()) . "\n\n\n";
    }
}