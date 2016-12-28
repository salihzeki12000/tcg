<?php

namespace frontend\controllers;

use Yii;
use common\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use frontend\components\BaseController;

/**
 * AboutController implements the CRUD actions for Tour model.
 */
class AboutController extends BaseController
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $article_name = Yii::t('app','Who Are We');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['title'] = $article_name;
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name]);
    }

    public function actionOurGuides()
    {
        $article_name = Yii::t('app','Our Guides');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['title'] = $article_name;
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name.'?']);
    }

    public function actionDriversAndVehicles()
    {
        $article_name = Yii::t('app','Drivers and Vehicles');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['title'] = $article_name;
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>Yii::t('app','Drivers & Vehicles')]);
    }

    public function actionMeetOurTeam()
    {
        $article_name = Yii::t('app','Meet Our Team');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['title'] = $article_name;
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name]);
    }

    public function actionContactUs()
    {
        $article_name = Yii::t('app','Contact Us');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['title'] = $article_name;
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name]);
    }

    public function actionCompanyPolicies()
    {
        $article_name = Yii::t('app','Company policies');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['title'] = $article_name;
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('view',['article'=>$article, 'sub_title'=>$article_name]);
    }

}
