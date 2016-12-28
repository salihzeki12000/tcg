<?php

namespace frontend\controllers;

use Yii;
use common\models\Tour;
use common\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\components\BaseController;

/**
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class FaqController extends BaseController
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_FAQ;
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Article::find()->where($condition);

        $faq = $query
            ->orderBy('create_time ASC')
            ->all();

        return $this->render('index',['faq'=>$faq]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($title)
    {
        $faq = $this->findModel($title);
        $id = $faq['id'];

        $condition = array();
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Tour::find()->where($condition);
        $query->andWhere("FIND_IN_SET('".REC_TYPE_POPULAR."', rec_type)");
        $tours = $query
            ->orderBy('priority DESC, id DESC')
            ->all();

        return $this->render('view', [
            'faq' => $faq,
            'tours' => $tours,
        ]);
    }


    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($title)
    {
        if (($model = Article::find()->where(['title' => $title])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('The requested page does not exist.'));
        }
    }
}
