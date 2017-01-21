<?php

namespace frontend\controllers;

use Yii;
use common\models\Tour;
use common\models\Cities;
use common\models\TourSearch;
use common\models\Itinerary;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use frontend\components\BaseController;

/**
 * CountMeInController implements the CRUD actions for Tour model.
 */
class CountMeInController extends Controller
{
    public $tour_type = TOUR_TYPE_GROUP;

    public function behaviors()
    {
        return [
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 60,
                'variations' => [
                    Yii::$app->language,
                    Yii::$app->params['currency'],
                    Yii::$app->params['is_mobile'],
                ],
                'enabled' => false,
            ],
        ];
    }
    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $condition = array();
        $condition['status'] = DIS_STATUS_SHOW;
        $condition['type'] = $this->tour_type;
        $query = Tour::find()->where($condition);

        $count_query = clone $query;
        $pages = new Pagination(
            [
                'totalCount' => $count_query->count(),
                'pageSize' => 12,
                'pageSizeParam' => false,
            ]);
        $tours = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $themes_query = \common\models\Theme::find()->where(['status'=>DIS_STATUS_SHOW]);
        $themes = $themes_query
            ->orderBy('priority DESC, id ASC')
            ->all();

        return $this->render('index',['tours'=>$tours,'type'=>$this->tour_type,'pages'=>$pages]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($name)
    {
        $tour_info = $this->findModel($name);
        $id = $tour_info['id'];

        $ftype = BIZ_TYPE_TOUR;
        $sql = "select a.id as `fu_id`,b.* from file_use a join uploaded_files b on a.fid=b.id where a.type={$ftype} and a.cid={$id}";
        $tour_images = Yii::$app->db->createCommand($sql)
        ->queryAll();

        $tour_info['images'] = [];
        if (!empty($tour_images)) {
            $tour_info['images'] = $tour_images;
        }

        $itineraries = Itinerary::find()
        ->where(['tour_id'=>$id])
        ->orderBy('day ASC')
        ->all();
        foreach ($itineraries as &$itinerary) {
            $ftype = BIZ_TYPE_ITINERARY;
            $sql = "select a.id as `fu_id`,b.* from file_use a join uploaded_files b on a.fid=b.id where a.type={$ftype} and a.cid={$itinerary['id']}";
            $itinerary_images = Yii::$app->db->createCommand($sql)
            ->queryAll();
            $itinerary['images'] = $itinerary_images;
        }

        return $this->render('view', [
            'tour_info' => $tour_info,
            'itinerary_info' => $itineraries,
        ]);
    }


    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        if (($model = Tour::find()->where(['name' => $name, 'type' => $this->tour_type])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
