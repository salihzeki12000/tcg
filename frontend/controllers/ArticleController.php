<?php

namespace frontend\controllers;

use Yii;
use common\models\Tour;
use common\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use frontend\components\BaseController;

/**
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class ArticleController extends BaseController
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_ARTICLE;
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Article::find()->where($condition);

        $count_query = clone $query;
        $pages = new Pagination(
            [
                'totalCount' => $count_query->count(),
                'pageSize' => 20,
                'pageSizeParam' => false,
            ]);
        $articles = $query
            ->orderBy('create_time DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index',['articles'=>$articles,'pages'=>$pages]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($title)
    {
        $article = $this->findModel($title);
        $id = $article['id'];

        $condition = array();
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Tour::find()->where($condition);
        $query->andWhere("FIND_IN_SET('".REC_TYPE_POPULAR."', rec_type)");
        $tours = $query
            ->orderBy('priority DESC, id DESC')
            ->all();

        return $this->render('view', [
            'article' => $article,
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
