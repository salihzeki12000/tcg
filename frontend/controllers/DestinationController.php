<?php

namespace frontend\controllers;

use Yii;
use common\models\Tour;
use common\models\TourSearch;
use common\models\Cities;
use common\models\Album;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class DestinationController extends Controller
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $type = Yii::$app->request->get('type');

        $condition = array();
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Cities::find()->where($condition);
        $cities = $query
            ->orderBy('id ASC')
            ->all();

        return $this->render('index',['cities'=>$cities]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($name)
    {
        $city_base = $this->getCityBaseInfo($name);
        $city_info = $city_base['city_info'];
        $menu = $city_base['menu'];

        return $this->render('view', [
            'city_info' => $city_info,
            'menu' => $menu,
        ]);
    }

    public function actionExperiences($name)
    {
        $city_base = $this->getCityBaseInfo($name);
        $city_info = $city_base['city_info'];
        $menu = $city_base['menu'];

        $condition = array();
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Tour::find()->where($condition);
        $query->andWhere("FIND_IN_SET('".$city_info['id']."', cities)");

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


        return $this->render('experiences', [
            'city_info' => $city_info,
            'menu' => $menu,
            'tours'=>$tours,
            'pages'=>$pages,
        ]);
    }

    public function actionSights($name)
    {
        $city_base = $this->getCityBaseInfo($name);
        $city_info = $city_base['city_info'];
        $menu = $city_base['menu'];

        $condition = array();
        $condition['type'] = ALBUM_TYPE_SIGHT;
        $condition['status'] = DIS_STATUS_SHOW;
        $condition['city_id'] = $city_info['id'];
        $query = Album::find()->where($condition);

        $count_query = clone $query;
        $pages = new Pagination(
            [
                'totalCount' => $count_query->count(),
                'pageSize' => 20,
                'pageSizeParam' => false,
            ]);
        $sights = $query
            ->orderBy('id ASC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('sights', [
            'city_info' => $city_info,
            'menu' => $menu,
            'sights' => $sights,
            'pages'=>$pages,
        ]);
    }

    public function actionActivities($name)
    {
        $city_base = $this->getCityBaseInfo($name);
        $city_info = $city_base['city_info'];
        $menu = $city_base['menu'];

        $condition = array();
        $condition['type'] = ALBUM_TYPE_ACTIVITY;
        $condition['status'] = DIS_STATUS_SHOW;
        $condition['city_id'] = $city_info['id'];
        $query = Album::find()->where($condition);

        $count_query = clone $query;
        $pages = new Pagination(
            [
                'totalCount' => $count_query->count(),
                'pageSize' => 20,
                'pageSizeParam' => false,
            ]);
        $activities = $query
            ->orderBy('id ASC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('activities', [
            'city_info' => $city_info,
            'menu' => $menu,
            'activities' => $activities,
            'pages'=>$pages,
        ]);
    }

    public function actionFood($name)
    {
        $city_base = $this->getCityBaseInfo($name);
        $city_info = $city_base['city_info'];
        $menu = $city_base['menu'];

        return $this->render('food', [
            'city_info' => $city_info,
            'menu' => $menu,
        ]);
    }

    public function actionVirtualtours($name)
    {
        $city_base = $this->getCityBaseInfo($name);
        $city_info = $city_base['city_info'];
        $menu = $city_base['menu'];

        return $this->render('virtualtours', [
            'city_info' => $city_info,
            'menu' => $menu,
        ]);
    }


    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        if (($model = Cities::find()->where(['name' => $name])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('The requested page does not exist.'));
        }
    }

    protected function getCityBaseInfo($name)
    {
        $city_info = $this->findModel($name);
        $id = $city_info->id;

        $ftype = BIZ_TYPE_CITIES;
        $sql = "select a.id as `fu_id`,b.* from file_use a join uploaded_files b on a.fid=b.id where a.type={$ftype} and a.cid={$id}";
        $city_images = Yii::$app->db->createCommand($sql)
        ->queryAll();

        $city_info['images'] = [];
        if (!empty($city_images)) {
            $city_info['images'] = $city_images;
        }

        $menu = array();

        $tour_query = Tour::find()->where(['status'=>DIS_STATUS_SHOW]);
        $tour_query->andWhere("FIND_IN_SET('".$id."', cities)");
        $exp_count = $tour_query
            ->count();
        if ($exp_count>0) {
            $menu['experiences'] = 'Experiences';
        }

        if (!empty($city_info['vr'])) {
            $menu['virtualtours'] = 'Virtual Tours';
        }

        $album_query = \common\models\Album::find()->where(['city_id'=>$id, 'type'=>ALBUM_TYPE_SIGHT, 'status'=>DIS_STATUS_SHOW]);
        $sight_count = $album_query
            ->count();
        if ($sight_count>0) {
            $menu['sights'] = 'Sights';
        }

        $album_query = \common\models\Album::find()->where(['city_id'=>$id, 'type'=>ALBUM_TYPE_ACTIVITY, 'status'=>DIS_STATUS_SHOW]);
        $act_count = $album_query
            ->count();
        if ($act_count>0) {
            $menu['activities'] = 'Activities';
        }

        if (!empty($city_info['food'])) {
            $menu['food'] = 'Food';
        }

        return [
            'city_info' => $city_info,
            'menu' => $menu,
        ];
    }

}
