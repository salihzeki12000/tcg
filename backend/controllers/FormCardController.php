<?php

namespace backend\controllers;

use Yii;
use common\models\FormCard;
use common\models\FormCardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * FormCardController implements the CRUD actions for FormCard model.
 */
class FormCardController extends Controller
{

    public $canView = 0;
    public $canDel = 0;
    public $canMod = 1;

    public function beforeAction($action)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);

        if (isset($roles['admin']) || isset($roles['site master'])) {
            $this->canView = 1;
            $this->canDel = 1;
            $this->canMod = 1;
        }
        if (isset($roles['Accountant'])) {
            $this->canMod = 1;
            $this->canView = 1;
        }
        if (isset($roles['role-admin-r'])) {
            $this->canDel = 1;
        }

        return parent::beforeAction($action);
    }

    public function render($templateName, $data=[])
    {
        $tmp['canDel'] = $this->canDel;
        $tmp['canMod'] = $this->canMod;
        $tmp['canView'] = $this->canView;
        $data['permission'] = $tmp;
        return parent::render($templateName, $data);
    }

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
    public function actionIndex()
    {
        if (!isset($_GET['sort'])) {
            $_GET['sort'] = '-create_time';
        }
        $searchModel = new FormCardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FormCard model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!$this->canView) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FormCard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FormCard();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
    public function actionUpdate($id)
    {
        if (!$this->canMod) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (($cfg_row = \common\models\EnvironmentVariables::findOne('travel_agents_mail')) !== null) {
                $json_val = $cfg_row['value'];
                $agent_list = json_decode($json_val, true);
                if (!empty($agent_list) && $agent_list[$model->travel_agent]) {
                    $model->agent_mail = $agent_list[$model->travel_agent];
                }
            }
            $model->update_time = date('Y-m-d H:i:s',time());
            if ($model->save()) {

                $mail_subject = "CreditCard-{$model->client_name}-{$model->amount_to_bill}-{$model->tour_date}-Agent:{$model->travel_agent}-" . Yii::$app->params['card_status'][$model->status];
                $receiver[] = 'creditcard@thechinaguide.com';
                if (!empty($model->agent_mail)) {
                    $receiver[] = $model->agent_mail;
                }
                $real_card_number = \yii::$app->security->decryptByPassword(base64_decode($model->card_number),SECRET_SECRET_KEY);
                $model->card_number = '****' . substr($real_card_number, -4);
                $model->card_security_code = '****';
                $model->expiry_month = '**';
                $model->expiry_year = '**';
                $model->billing_address = '****';
                Yii::$app->mailer->compose('card', ['model' => $model]) 
                    ->setTo($receiver) 
                    ->setSubject($mail_subject) 
                    ->send();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FormCard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!$this->canDel) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        if (($model = FormCard::findOne($id)) !== null) {
            $model->update_time = date('Y-m-d H:i:s',time());
            $model->status = -1;
            $model->save();
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->redirect(['index']);
    }

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
