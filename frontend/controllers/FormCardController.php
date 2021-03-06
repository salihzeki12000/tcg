<?php

namespace frontend\controllers;

use Yii;
use common\models\FormCard;
use common\models\FormCardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormCardController implements the CRUD actions for FormCard model.
 */
class FormCardController extends Controller
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
     * Lists all FormCard models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $searchModel = new FormCardSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single FormCard model.
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
     * Creates a new FormCard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FormCard();

        if ($model->load(Yii::$app->request->post())) {
            if (($cfg_row = \common\models\EnvironmentVariables::findOne('travel_agents_mail')) !== null) {
                $json_val = $cfg_row['value'];
                $agent_list = json_decode($json_val, true);
                if (!empty($agent_list) && $agent_list[$model->travel_agent]) {
                    $model->agent_mail = $agent_list[$model->travel_agent];
                }
            }
            if (isset($_POST['FormCard']['donation'])) {
                if ($model->donation == 'other_donation') {
                    if (isset($_POST['other_donation']) && !empty($_POST['other_donation'])) {
                        $model->donation = $_POST['other_donation'];
                    }
                    else{
                        $model->donation = '';
                    }
                }
            }

            $real_card_number = $model->card_number;
            $model->create_time = date('Y-m-d H:i:s',time());
            $model->status = CARD_STATUS_CHARGED;
            if ($model->save()) {
                $mail_subject = "CreditCard-{$model->client_name}-{$model->amount_to_bill}-{$model->tour_date}-Agent:{$model->travel_agent}";
                $receiver[] = 'creditcard@thechinaguide.com';
                if (!empty($model->donation)) {
                    $receiver[] = 'operations@thechinaguide.com';
                }
                if (!empty($model->agent_mail)) {
                    $receiver[] = $model->agent_mail;
                }
                $model->card_number = '****' . substr($real_card_number, -4);
                $model->card_security_code = '****';
                $model->expiry_month = '**';
                $model->expiry_year = '**';
                $model->billing_address = '****';
                Yii::$app->mailer->compose('card', ['model' => $model]) 
                    ->setTo($receiver) 
                    ->setSubject($mail_subject) 
                    ->send();

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
     * Updates an existing FormCard model.
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
     * Deletes an existing FormCard model.
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
     * Finds the FormCard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FormCard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FormCard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
