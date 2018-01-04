<?php

namespace frontend\controllers;

use Yii;
use common\models\OaFeedback;
use common\models\OaFeedbackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormFeedbackController implements the CRUD actions for OaFeedback model.
 */
class FormFeedbackController extends Controller
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
     * Lists all OaFeedback models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $searchModel = new OAFeedbackSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single OaFeedback model.
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

    public function actionSuccess()
    {

        return $this->render('view', []);
    }

    /**
     * Creates a new OaFeedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaFeedback();

        if($model->load(Yii::$app->request->post())) {
	        if(($cfg_row = \common\models\EnvironmentVariables::findOne('travel_agents_mail')) !== null) {
                $json_val = $cfg_row['value'];
                $agent_list = json_decode($json_val, true);
                if (!empty($agent_list) && $agent_list[$model->agent]) {
                    $agent_mail = $agent_list[$model->agent];
                }
            }
            
            if($model->save()) {
                $mail_subject = "Feedback from {$model->client_name} ({$model->client_email})";
                $receiver[] = 'feedback@thechinaguide.com';
                if(!empty($agent_mail)) {
                    $receiver[] = $agent_mail;
                }

                /* Yii::$app->mailer->compose('feedback', ['model' => $model]) 
                    ->setTo($receiver) 
                    ->setSubject($mail_subject) 
                    ->send(); */

                return $this->redirect(['success']);
            }
            else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaFeedback model.
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
     * Deletes an existing OaFeedback model.
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
     * Finds the OaFeedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaFeedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaFeedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
