<?php

namespace frontend\controllers;

use Yii;
use common\models\Tour;
use common\models\TourSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class ExperienceController extends Controller
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sql = "SELECT t.*,GROUP_CONCAT(c.`name`) AS cities_name FROM tour t JOIN cities c ON FIND_IN_SET(c.id, t.cities) WHERE t.`status` = ".DIS_STATUS_SHOW."  GROUP BY t.id ORDER BY t.id DESC  LIMIT 0, 10 ";
        $tours = Yii::$app->db->createCommand($sql)
        ->queryAll();

        return $this->render('index',['tours'=>$tours]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tour::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
