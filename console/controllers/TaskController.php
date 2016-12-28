<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class TaskController extends Controller
{    
    public function actionIndex()
    {
        echo "sync task begin:" . date('Y-m-d H:i:s',time()) . "\n";
        $tables = ['album','article','cities','homepage','itinerary','tour',];
        $languages = array_keys(Yii::$app->params['language_name']);
        unset($languages[0]);

        foreach ($tables as $table) {
            $sql = "select * from $table";
            $items = Yii::$app->db->createCommand($sql)
            ->queryAll();
            if (!empty($items)) {
                foreach ($languages as $language) {
                    $sync_table = $table . '_' . $language;
                    foreach ($items as $item) {
                        $sql = "select * from $sync_table where id=:id";
                        $row = Yii::$app->db->createCommand($sql)
                        ->bindParam(':id', $item['id'])
                        ->queryOne();
                        if (empty($row)) {
                            $item['sync_time'] = date('Y-m-d H:i:s',time());
                            $item['update_time'] = null;
                            $ret = Yii::$app->db->createCommand()->insert($sync_table, $item)->execute();
                            echo "create item $table -> $sync_table id:" . $item['id'] . "\n";
                        }
                        elseif (empty($row['update_time']) && $row['sync_time']<$item['update_time']) {
                            $item['sync_time'] = date('Y-m-d H:i:s',time());
                            $item['update_time'] = null;
                            $ret = Yii::$app->db->createCommand()->update($sync_table, $item, 'id = '.$item['id'])->execute();
                            echo "update item $table -> $sync_table id:" . $item['id'] . "\n";
                        }
                    }
                }
            }
        }
        echo "sync task end:" . date('Y-m-d H:i:s',time()) . "\n\n\n";
    }
}