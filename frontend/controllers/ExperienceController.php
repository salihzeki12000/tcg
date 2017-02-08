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
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class ExperienceController extends Controller
{
    public $enableCsrfValidation = false;
    public $tour_type = TOUR_TYPE_NORMAL;

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
        $theme = trim(Yii::$app->request->get('theme'));
        $theme = str_replace('-', ' ', $theme);
        $theme_id = '';

        if (empty($theme)) {
            $theme_id = TOUR_THEMES_MOST_POPULAR;
            $theme_info = \common\models\Theme::find()->where(['id' => $theme_id])->One();
            $tour_ids = $theme_info['use_ids'];
            $theme_name = $theme_info['name'];
        }
        elseif (($theme_info = \common\models\Theme::find()->where(['name' => $theme])->One()) !== null) {
            $tour_ids = $theme_info['use_ids'];
            $theme_id = $theme_info['id'];
            $theme_name = $theme_info['name'];
        }
        $condition = array();
        $condition['status'] = DIS_STATUS_SHOW;
        $condition['type'] = $this->tour_type;
        if (!empty($tour_ids)) {
            $tour_ids = explode(',', $tour_ids);
            $condition['id'] = $tour_ids;
            
        }
        $query = Tour::find()->where($condition);

        if (!empty($tour_ids)) {
            $query->orderBy([new \yii\db\Expression('FIELD (id, ' . implode(',', $tour_ids) . ')')]);
        }

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

        return $this->render('index',['tours'=>$tours,'type'=>$this->tour_type,'themes'=>$themes,'theme_id'=>$theme_id,'theme_name'=>$theme_name,'pages'=>$pages]);
    }

    public function actionSearch()
    {
        $default_cids = ['1','2','3'];
        $default_leng = 9;
        $tours = [];

        if ($post_data = Yii::$app->request->post()) {
            if (isset($post_data['tour_cities'])) {
                $tour_cities = $post_data['tour_cities'];
            }

            $tour_length = $post_data['tour_length'];

            if (empty($tour_cities)) {
                $tour_cities = [];
            }
            if (empty($tour_length)) {
                $tour_length = $default_leng;
            }
            $condition = array();
            $condition['status'] = DIS_STATUS_SHOW;
            $condition['type'] = $this->tour_type;
            $query = Tour::find()->where($condition);
            $arr_and = ['and'];
            foreach ($tour_cities as $city_id) {
                $arr_and[] = new \yii\db\Expression("FIND_IN_SET('".$city_id."', cities)");
            }
            $query->andFilterWhere($arr_and);
            // echo $query->createCommand()->sql;exit;
            $tours = $query
            ->orderBy('ABS(`tour_length` - '.$tour_length.') ASC')
            ->limit(9)
            ->all();
        }
        else{
            $tour_cities = $default_cids;
            $tour_length = $default_leng;
        }
        $cities_query = \common\models\Cities::find()->where(['status'=>DIS_STATUS_SHOW]);
        $cities = $cities_query
            ->orderBy('priority DESC, id ASC')
            ->all();

        foreach ($cities as &$city) {
            $city->sel = 0;
            if (in_array($city['id'], $tour_cities) ) {
                $city->sel = 1;
            }
        }

        return $this->render('search',['cities'=>$cities, 'tours'=>$tours, 'tour_length'=>$tour_length]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($name)
    {
        $name = str_replace('-', ' ', $name);
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
        $condition['type'] = $this->tour_type;
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
        if (($model = Tour::find()->where(['name' => $name, 'type' => $this->tour_type])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
