<?php

namespace frontend\controllers;

use Yii;
use common\models\Tour;
use common\models\TourSearch;
use common\models\Itinerary;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use frontend\components\BaseController;

/**
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class ExperienceController extends BaseController
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $type = Yii::$app->request->get('type');
        $theme = trim(Yii::$app->request->get('theme'));
        $theme_id = '';

        $condition = array();
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Tour::find()->where($condition);
        if ($type) {
            $query->andWhere("FIND_IN_SET('".$type."', rec_type)");
        }
        if (empty($theme)) {
            $theme_id = TOUR_THEMES_MOST_POPULAR;
        }
        else
        {
            $theme_id = array_search($theme, Yii::$app->params['tour_themes']);
        }
        if ($theme_id) {
            $query->andWhere("FIND_IN_SET('".$theme_id."', themes)");
        }

        $count_query = clone $query;
        $pages = new Pagination(
            [
                'totalCount' => $count_query->count(),
                'pageSize' => 10,
                'pageSizeParam' => false,
            ]);
        $tours = $query
            ->orderBy('priority DESC, id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index',['tours'=>$tours,'type'=>$type,'theme_id'=>$theme_id,'pages'=>$pages]);
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

        $rec_ids = $tour_info['link_tour'];
        $rec_ids = explode(',', $rec_ids);
        $condition = array();
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Tour::find()->where($condition);
        if (!empty($rec_ids)) {
            $query->andWhere(['id' => $rec_ids]);
        }
        $tours = $query
            ->orderBy('priority DESC, id DESC')
            ->all();

        return $this->render('view', [
            'tour_info' => $tour_info,
            'itinerary_info' => $itineraries,
            'tours' => $tours,
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
        if (($model = Tour::find()->where(['name' => $name])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
