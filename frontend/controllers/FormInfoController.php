<?php

namespace frontend\controllers;

use Yii;
use common\models\FormInfo;
use common\models\FormInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormInfoController implements the CRUD actions for FormInfo model.
 */
class FormInfoController extends Controller
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
     * Lists all FormInfo models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $searchModel = new FormInfoSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single FormInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new FormInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($form_type)
    {
        // $form_type = FORM_TYPE_CUSTOM;
        // $form_type = FORM_TYPE_QUOTATION;
        // $form_type = FORM_TYPE_EDU;
        // $form_type = FORM_TYPE_MICE;

        $model = new FormInfo($form_type);

        if ($model->load(Yii::$app->request->post())) {
            if (array_key_exists('cities_plan', $_POST['FormInfo']) && !empty($_POST['FormInfo']['cities_plan'])) {
                $model->cities_plan = join(',', $_POST['FormInfo']['cities_plan']);
            }
            if (array_key_exists('travel_interests', $_POST['FormInfo']) && !empty($_POST['FormInfo']['travel_interests'])) {
                $model->travel_interests = join(',', $_POST['FormInfo']['travel_interests']);
            }
            $model->create_time = date('Y-m-d H:i:s',time());
            if ($model->save()) {

                $mail_subject = "Inquiry"
                    . ($model->prefered_travel_agent?"-{$model->prefered_travel_agent}":"")
                    . '-' . Yii::$app->params['form_types'][$model->type]
                    . ($model->tour_code?"-{$model->tour_code}":"")
                    . ($model->tour_length?"-{$model->tour_length} Days":"")
                    . ($model->adults?"-{$model->adults} Guests":'')
                    . ($model->participants_number?"-{$model->participants_number} Guests":'')
                    . ($model->arrival_date?"-{$model->arrival_date}":'')
                    . ($model->name?"-{$model->name}":'');

                $receiver[] = 'book@thechinaguide.com';

                Yii::$app->mailer->compose('form', ['model' => $model,'form_type' => $form_type,])
                    ->setTo($receiver)
                    ->setSubject($mail_subject)
                    ->send();

                return $this->redirect(['view', 'id' => $model->id]);

            }
        }

        return $this->render('create', [
            'model' => $model,
            'form_type' => $form_type,
        ]);
    }

    /**
     * Updates an existing FormInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Deletes an existing FormInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the FormInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FormInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FormInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
