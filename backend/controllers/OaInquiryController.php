<?php

namespace backend\controllers;

use Yii;
use common\models\OaInquiry;
use common\models\OaInquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OaInquiryController implements the CRUD actions for OaInquiry model.
 */
class OaInquiryController extends Controller
{
    /**
     * @inheritdoc
     */
    public $canAdd = 0;
    public $canDel = 0;
    public $canMod = 1;

    public function beforeAction($action)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);
        if (isset($roles['OA-Admin'])) {
            $this->canAdd = 1;
            $this->canDel = 1;
        }
        return parent::beforeAction($action);
    }

    public function render($templateName, $data=[])
    {
        $tmp['canAdd'] = $this->canAdd;
        $tmp['canDel'] = $this->canDel;
        $tmp['canMod'] = $this->canMod;
        $data['permission'] = $tmp;
        return parent::render($templateName, $data);
    }

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
     * Lists all OaInquiry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OaInquirySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OaInquiry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $cities = ArrayHelper::map(\common\models\OaCity::find()->where(['id' => explode(',', $model->cities)])->all(), 'id', 'name');
        $model->cities = join(',', array_values($cities));

        $agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->agent])->all(), 'id', 'username');
        if (array_key_exists($model->agent, $agent)) {
            $model->agent = $agent[$model->agent];
        }

        $co_agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->co_agent])->all(), 'id', 'username');
        if (array_key_exists($model->co_agent, $co_agent)) {
            $model->co_agent = $co_agent[$model->co_agent];
        }

        $model->tour_type = Yii::$app->params['form_types'][$model->tour_type];

        $model->close = Yii::$app->params['yes_or_no'][$model->close];

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new OaInquiry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ($this->canAdd != 1) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = new OaInquiry();

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['OaInquiry']['cities']) && is_array($_POST['OaInquiry']['cities'])) {
                $model->cities = join(',', $_POST['OaInquiry']['cities']);
            }
            $model->create_time = date('Y-m-d H:i:s',time());

            if ($model->save()) {
                # code...
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->cities = explode(',', $model->cities);
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaInquiry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['OaInquiry']['cities']) && is_array($_POST['OaInquiry']['cities'])) {
                $model->cities = join(',', $_POST['OaInquiry']['cities']);
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
     * Deletes an existing OaInquiry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($this->canDel != 1) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OaInquiry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaInquiry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaInquiry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
