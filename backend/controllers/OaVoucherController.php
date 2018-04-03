<?php

namespace backend\controllers;

use Yii;
use common\models\OaVoucher;
use common\models\OaVoucherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * OaVoucherController implements the CRUD actions for OaVoucher model.
 */
class OaVoucherController extends Controller
{
    public $isAdmin = 0;

    public function beforeAction($action)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);
        
        if(isset($roles['OA-Admin'])) {
            $this->isAdmin = 1;
        }

        return parent::beforeAction($action);
    }

    public function render($templateName, $data=[])
    {
        $tmp['isAdmin'] = $this->isAdmin;
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
     * Lists all OaVoucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OaVoucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OaVoucher model.
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
     * Creates a new OaVoucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!$this->isAdmin) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        
        $model = new OaVoucher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaVoucher model.
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
     * Deletes an existing OaVoucher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!$this->isAdmin) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OaVoucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaVoucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaVoucher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
