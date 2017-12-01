<?php

namespace backend\controllers;

use Yii;
use common\models\OaTour;
use common\models\OaTourSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OaTourController implements the CRUD actions for OaTour model.
 */
class OaTourController extends Controller
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
     * Lists all OaTour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OaTourSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OaTour model.
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
     * Creates a new OaTour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaTour();

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['OaTour']['cities']) && is_array($_POST['OaTour']['cities'])) {
                $model->cities = join(',', $_POST['OaTour']['cities']);
            }
            $inquiry_id = $model->inquiry_id;
            if (($inquiryModel = \common\models\OaInquiry::findOne($inquiry_id)) !== null) {
                $model->inquiry_source = $inquiryModel->inquiry_source;
                $model->language = $inquiryModel->language;
                $model->agent = $inquiryModel->agent;
                $model->co_agent = $inquiryModel->co_agent;
                $model->tour_type = $inquiryModel->tour_type;
                $model->group_type = $inquiryModel->group_type;
                $model->country = $inquiryModel->country;
                $model->organization = $inquiryModel->organization;
                $model->number_of_travelers = $inquiryModel->number_of_travelers;
                $model->traveler_info = $inquiryModel->traveler_info;
                $model->tour_start_date = $inquiryModel->tour_start_date;
                $model->tour_end_date = $inquiryModel->tour_end_date;
                $model->cities = $inquiryModel->cities;
                $model->contact = $inquiryModel->contact;
                $model->email = $inquiryModel->email;
                $model->other_contact_info = $inquiryModel->other_contact_info;
                $model->tour_schedule_note = $inquiryModel->tour_schedule_note;
                $model->create_time = date('Y-m-d H:i:s',time());

                if ($model->save()) {
                    # code...
                }
            }
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaTour model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['OaTour']['cities']) && is_array($_POST['OaTour']['cities'])) {
                $model->cities = join(',', $_POST['OaTour']['cities']);
            }
            if ($model->save()) {
                # code...
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->cities = explode(',', $model->cities);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OaTour model.
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
     * Finds the OaTour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaTour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaTour::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
