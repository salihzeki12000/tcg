<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class SitemapController extends Controller
{

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $site_root = SITE_BASE_URL;
        $data = [];

        $pages = [
            '/destinations',
            '/experiences',
            '/theme-tour',
            '/blogs',
            '/preparation',
            '/about-us',
            '/about-us/drivers-and-vehicles',
            '/about-us/contact-us',
            '/about-us/meet-our-team',
            '/about-us/our-guides',
            '/company-policies',
            '/educational-programs',
        ];

        $query = \common\models\Tour::find()->where(['status'=>DIS_STATUS_SHOW, 'type' => TOUR_TYPE_NORMAL]);
        $data['tours'] = $query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $query = \common\models\Tour::find()->where(['status'=>DIS_STATUS_SHOW, 'type' => TOUR_TYPE_GROUP]);
        $data['group_tour'] = $query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $cities_query = \common\models\Cities::find()->where(['status'=>DIS_STATUS_SHOW]);
        $data['cities'] = $cities_query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $themes_query = \common\models\Theme::find()->where(['status'=>DIS_STATUS_SHOW]);
        $data['themes'] = $themes_query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $query = \common\models\Album::find()->where(['status'=>DIS_STATUS_SHOW, 'type' => ALBUM_TYPE_SIGHT]);
        $data['sight'] = $query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $query = \common\models\Album::find()->where(['status'=>DIS_STATUS_SHOW, 'type' => ALBUM_TYPE_ACTIVITY]);
        $data['activity'] = $query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $faq_query = \common\models\Article::find()->where(['type'=>ARTICLE_TYPE_FAQ, 'status'=>DIS_STATUS_SHOW]);
        $data['faq'] = $faq_query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $article_query = \common\models\Article::find()->where(['type'=>ARTICLE_TYPE_ARTICLE, 'status'=>DIS_STATUS_SHOW]);
        $data['articles'] = $article_query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $article_query = \common\models\Article::find()->where(['type'=>ARTICLE_TYPE_PREPARATION, 'status'=>DIS_STATUS_SHOW]);
        $data['misc'] = $article_query
            ->orderBy('priority DESC, create_time DESC')
            ->all();


        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        echo $this->renderPartial('index',['site_root'=>$site_root, 'data'=>$data, 'pages'=>$pages]);
    }

}
