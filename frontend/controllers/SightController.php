<?php

namespace frontend\controllers;

use Yii;
use common\models\Album;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class SightController extends Controller
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($url_id)
    {
        $sight_info = $this->findModel($url_id);
        $id = $sight_info['id'];

        // $ftype = BIZ_TYPE_ALBUM;
        // $sql = "select a.id as `fu_id`,b.* from file_use a join uploaded_files b on a.fid=b.id where a.type={$ftype} and a.cid={$id}";
        // $album_images = Yii::$app->db->createCommand($sql)
        // ->queryAll();

        // $sight_info['images'] = [];
        // if (!empty($album_images)) {
        //     $sight_info['images'] = $album_images;
        // }

        $cities_query = \common\models\Cities::find()->where(['id'=>$sight_info['city_id']]);
        $city_info = $cities_query
            ->One();

        $ftype = BIZ_TYPE_CITIES;
        $sql = "select a.id as `fu_id`,b.* from file_use a join uploaded_files b on a.fid=b.id where a.type={$ftype} and a.cid={$city_info['id']}";
        $city_images = Yii::$app->db->createCommand($sql)
        ->queryAll();

        $city_info['images'] = [];
        if (!empty($city_images)) {
            $city_info['images'] = $city_images;
        }

        return $this->render('view', [
            'sight_info' => $sight_info,
            'city_info' => $city_info,
        ]);
    }


    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($url_id)
    {
        if (($model = Album::find()->where(['url_id' => $url_id])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
