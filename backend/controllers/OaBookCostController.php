<?php

namespace backend\controllers;

use Yii;
use common\models\OaBookCost;
use common\models\OaBookCostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OaBookCostController implements the CRUD actions for OaBookCost model.
 */
class OaBookCostController extends Controller
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
     * Lists all OaBookCost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OaBookCostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OaBookCost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $model->type = Yii::$app->params['oa_book_cost_type'][$model->type];

        $model->need_to_pay = Yii::$app->params['yes_or_no'][$model->need_to_pay];

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new OaBookCost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type=0)
    {
        $model = new OaBookCost();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_time = date('Y-m-d H:i:s',time());
            $model->creator = Yii::$app->user->identity->id;
            $tour_id = $model->tour_id;
            if (($tourModel = \common\models\OaTour::findOne($tour_id)) !== null) {
                if ($model->type == OA_BOOK_COST_TYPE_GUIDE) {
                    if (($fModel = \common\models\OaGuide::findOne($model->fid)) !== null) {
                        $model->cl_info = $fModel->cl_english;
                    }
                }
                elseif ($model->type == OA_BOOK_COST_TYPE_HOTEL) {
                    if (($fModel = \common\models\OaHotel::findOne($model->fid)) !== null) {
                        $model->cl_info = $fModel->cl_english;
                    }
                }
                if ($model->save()) {
                    # code...
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->type = $type;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaBookCost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model['type'])) {
                unset($model['type']);
            }
            if ($model->save()) {
                # code...
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OaBookCost model.
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
     * Finds the OaBookCost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaBookCost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaBookCost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
