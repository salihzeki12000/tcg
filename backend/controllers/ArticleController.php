<?php

namespace backend\controllers;

use Yii;
use common\models\Article;
use common\models\ArticleSearch;
use common\models\UploadedFiles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public $article_type = ARTICLE_TYPE_ARTICLE;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $_GET['ArticleSearch']['type'] = $this->article_type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            if (is_array($_POST['Article']['rec_type'])) {
                $model->rec_type = join(',', $_POST['Article']['rec_type']);
            }
            $file = \yii\web\UploadedFile::getInstance($model, 'image');
            if (!empty($file))
            {
                $tmp_name = $file->tempName;
                if ($tmp_name) {
                    $file_path = UploadedFiles::uploadFile($file);
                    if ($file_path)
                    {
                        $model->pic_s = $file_path;
                    }
                }
            }
            $model->create_time = date('Y-m-d H:i:s',time());
            if (Yii::$app->language == Yii::$app->sourceLanguage) {
                if (empty($model->url_id)) {
                    $model->url_id = strtolower(str_replace(' ', '-', $model->title));
                }
                else{
                    $url_id = strtolower($model->url_id);
                    if (($row = Article::find()->where(['url_id'=>$url_id])->one()) !== null) {
                        throw new ServerErrorHttpException(Yii::t('app', 'The link has exist.'));
                    } else {
                        $model->url_id = $url_id;
                    }
                }
                
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if (is_array($_POST['Article']['rec_type'])) {
                $model->rec_type = join(',', $_POST['Article']['rec_type']);
            }
            $file = \yii\web\UploadedFile::getInstance($model, 'image');
            if (!empty($file))
            {
                $tmp_name = $file->tempName;
                if ($tmp_name) {
                    $file_path = UploadedFiles::uploadFile($file);
                    if ($file_path)
                    {
                        $model->pic_s = $file_path;
                    }
                }
            }
            $model->update_time = date('Y-m-d H:i:s',time());
            if (Yii::$app->language == Yii::$app->sourceLanguage) {
                if (empty($model->url_id)) {
                    $model->url_id = strtolower(str_replace(' ', '-', $model->title));
                }
                else{
                    $url_id = strtolower($model->url_id);
                    if (($row = Article::find()->where(['url_id'=>$url_id])->andWhere(['<>','id',$model->id])->one()) !== null) {
                        throw new ServerErrorHttpException(Yii::t('app', 'The link has exist.'));
                    } else {
                        $model->url_id = $url_id;
                    }
                }
                
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function render($view, $params = [])
    {
        $params['type'] = $this->article_type;
        $view = '/article/' . $view;
        return parent::render($view, $params);
    }
}
