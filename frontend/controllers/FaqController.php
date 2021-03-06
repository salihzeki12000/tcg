<?php

namespace frontend\controllers;

use Yii;
use common\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * EducationalProgramsController implements the CRUD actions for Tour model.
 */
class FaqController extends Controller
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $article_name = Yii::t('app','FAQ');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['title'] = $article_name;
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name]);
    }

}
