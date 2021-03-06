<?php

namespace backend\controllers;

use Yii;
use common\models\Album;
use common\models\AlbumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlbumController implements the CRUD actions for Album model.
 */
class AlbumController extends Controller
{
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
     * Lists all Album models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Album model.
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
     * Creates a new Album model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Album();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->create_time = date('Y-m-d H:i:s',time());
            if (Yii::$app->language == Yii::$app->sourceLanguage) {
                $model->url_id = strtolower(str_replace(' ', '-', $model->name));
            }
            if (empty($model->description) && !empty($model->overview)) {
                $model->description = \common\models\Tools::wordcut(strip_tags($model->overview), 160);
            }
            if (Yii::$app->language == Yii::$app->sourceLanguage) {
                if (empty($model->url_id)) {
                    $model->url_id = strtolower(str_replace(' ', '-', $model->name));
                }
                else{
                    $url_id = strtolower($model->url_id);
                    if (($row = Album::find()->where(['url_id'=>$url_id])->one()) !== null) {
                        throw new ServerErrorHttpException(Yii::t('app', 'The link has exist.'));
                    } else {
                        $model->url_id = $url_id;
                    }
                }
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);   
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Album model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->update_time = date('Y-m-d H:i:s',time());
            if (empty($model->description)) {
                $model->description = \common\models\Tools::wordcut(strip_tags($model->overview), 160);
            }
            if (Yii::$app->language == Yii::$app->sourceLanguage) {
                if (empty($model->url_id)) {
                    $model->url_id = strtolower(str_replace(' ', '-', $model->name));
                }
                else{
                    $url_id = strtolower($model->url_id);
                    if (($row = Album::find()->where(['url_id'=>$url_id])->andWhere(['<>','id',$model->id])->one()) !== null) {
                        throw new ServerErrorHttpException(Yii::t('app', 'The link has exist.'));
                    } else {
                        $model->url_id = $url_id;
                    }
                }
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);   
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Album model.
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
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
