<?php

namespace backend\controllers;

use Yii;
use common\models\OaGuide;
use common\models\OaGuideSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OaGuideController implements the CRUD actions for OaGuide model.
 */
class OaGuideController extends Controller
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
     * Lists all OaGuide models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OaGuideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OaGuide model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $city_id = ArrayHelper::map(\common\models\OaCity::find()->where(['id' => $model->city_id])->all(), 'id', 'name');
        if (array_key_exists($model->city_id, $city_id)) {
            $model->city_id = $city_id[$model->city_id];
        }

        $agency = ArrayHelper::map(\common\models\OaAgency::find()->where(['id' => $model->agency])->all(), 'id', 'name');
        if (array_key_exists($model->agency, $agency)) {
            $model->agency = $agency[$model->agency];
        }

        $user_id = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->user_id])->all(), 'id', 'username');
        if (array_key_exists($model->user_id, $user_id)) {
            $model->user_id = $user_id[$model->user_id];
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new OaGuide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaGuide();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_time = date('Y-m-d H:i:s',time());
            if ($model->save()) {
                # code...
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaGuide model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OaGuide model.
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
     * Finds the OaGuide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaGuide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaGuide::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
