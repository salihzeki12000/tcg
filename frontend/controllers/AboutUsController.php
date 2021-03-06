<?php

namespace frontend\controllers;

use Yii;
use common\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AboutController implements the CRUD actions for Tour model.
 */
class AboutUsController extends Controller
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $article_name = Yii::t('app','Who we are');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['url_id'] = 'our-mission';
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name]);
    }

    public function actionOurGuides()
    {
        $article_name = Yii::t('app','Our guides');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['url_id'] = 'our-guides';
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name]);
    }

    public function actionDriversAndVehicles()
    {
        $article_name = Yii::t('app','Drivers and vehicles');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['url_id'] = 'drivers-and-vehicles';
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>Yii::t('app','Drivers and vehicles')]);
    }

    public function actionMeetOurTeam()
    {
        $article_name = Yii::t('app','Meet our team');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['url_id'] = 'meet-our-team';
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name]);
    }

    public function actionContactUs()
    {
        $article_name = Yii::t('app','Contact us');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['url_id'] = 'contact-us';
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('index',['article'=>$article, 'sub_title'=>$article_name]);
    }

    public function actionCompanyPolicies()
    {
        $article_name = Yii::t('app','Terms of Service');
        $description = Yii::t('app','');
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_PAGE;
        $condition['url_id'] = 'terms-of-service';
        $query = Article::find()->where($condition);

        $article = $query
            ->One();

        return $this->render('view',['article'=>$article, 'sub_title'=>$article_name, 'description'=>$description]);
    }

}
