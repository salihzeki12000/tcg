<?php

namespace frontend\controllers;

use Yii;
use common\models\Tour;
use common\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\Url;

/**
 * ExperiencesController implements the CRUD actions for Tour model.
 */
class ArticleController extends Controller
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
                'pageSize' => 10,
                'pageSizeParam' => false,
            ]);
        $articles = $query
            ->orderBy('priority DESC, create_time DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index',['articles'=>$articles,'pages'=>$pages]);
    }

    public function actionRss()
    {
        $condition = array();
        $condition['type'] = ARTICLE_TYPE_ARTICLE;
        $condition['status'] = DIS_STATUS_SHOW;
        $query = Article::find()->where($condition);

        $count_query = clone $query;
        $pages = new Pagination(
            [
                'totalCount' => $count_query->count(),
                'pageSize' => 100,
                'pageSizeParam' => false,
            ]);
        $articles = $query
            ->orderBy('priority DESC, create_time DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $response = Yii::$app->getResponse();
        $headers = $response->getHeaders();

        header('Content-Type: application/xml; charset=utf-8');

        foreach ($articles as $article) {
            $items[] = [
                    'title' => $article['title'],
                    'description' => \common\models\Tools::wordcut(strip_tags($article['content']), 550),
                    'link' => Url::toRoute(['article/view', 'url_id'=>$article['url_id']], true),
                    'guid' => $article['id'],
                    'pubDate' => $article['create_time'],
            ];
        }
        $channel = [
                'title' => Yii::t('app', 'The China Guide'),
                'link' => Url::toRoute('/', true),
                'description' => Yii::t('app','The China Guide, a Beijing-based travel agency run by a multilingual team of native speakers, creates private China tours & travel customization services'),
                'language' => Yii::$app->language,
        ];

        $xml = "<?xml version=\"1.0\"?><rss version=\"2.0\"><channel>";
        foreach ($channel as $key => $value) {
            $xml .= "<$key>" . htmlspecialchars($value) . "</$key>";
        }
        foreach ($items as $item) {
            $xml .= "<item>";
            foreach ($item as $key => $value) {
                $xml .= "<$key>" . htmlspecialchars($value) . "</$key>";
            }
            $xml .= "</item>";
        }
        $xml .= "</channel></rss>";

        echo $xml;
        exit;

    }
    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($url_id)
    {
        $article = $this->findModel($url_id);
        $id = $article['id'];

        return $this->render('view', [
            'article' => $article,
        ]);
    }


    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($url_id)
    {
        // if (($model = Article::find()->where('BINARY [[url_id]]=:url_id', ['url_id'=>$url_id])->one()) !== null) {
        if (($model = Article::find()->where(['url_id'=>$url_id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
