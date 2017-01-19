<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use common\models\Itinerary;
use common\models\ItinerarySearch;
use common\models\UploadedFiles;
use common\models\Tour;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * ItineraryController implements the CRUD actions for Itinerary model.
 */
class ItineraryController extends Controller
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
     * Lists all Itinerary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItinerarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Itinerary model.
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
     * Creates a new Itinerary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tour_id='')
    {
        $model = new Itinerary();
        $tour_info = array();

        $model->create_time = date('Y-m-d H:i:s',time());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id, 'tour_id'=>$model->tour_id]);
        } else {
            if (!empty($tour_id)) {
                $tour_info = Tour::find()->where(['id' => $tour_id])->one();
                $model->tour_id = $tour_info['id'];
            }
            return $this->render('create', [
                'model' => $model,
                'tour_info' => $tour_info,
            ]);
        }
    }

    /**
     * Updates an existing Itinerary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $p1 = $p2 = [];

        $tour_info = Tour::find()->where(['id' => $model->tour_id])->one();

        $model->update_time = date('Y-m-d H:i:s',time());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->post('add_next')) {
                return $this->redirect(['create', 'tour_id' => $model->tour_id]);
            }
            $to_route = 'tour/update';
            if($tour_info['type'] == TOUR_TYPE_GROUP)
            {
                $to_route = 'group-tour/update';
            }
            return $this->redirect([$to_route, 'id' => $model->tour_id]);
        } else {
            $ftype = BIZ_TYPE_ITINERARY;
            $sql = "select a.id as `fu_id`,b.* from file_use a join uploaded_files b on a.fid=b.id where a.type={$ftype} and a.cid={$id}";
            $file_use = Yii::$app->db->createCommand($sql)
            ->queryAll();

            foreach ($file_use as $key => $value) {
                $path = Yii::$app->params['uploads_url'] . UploadedFiles::getSize($value['path'], 's');
                $p1[$key] = $path;
                $p2[$key] = [
                    // 要删除商品图的地址
                    'url' => Url::toRoute('/uploaded-files/del-file-use'),
                    // 商品图对应的商品图id
                    'key' => $value['fu_id'],
                    'caption' => $value['org_name'],
                    'size' => $value['size'],
                    'width' => "120px",
                ];
            }

            return $this->render('update', [
                'model' => $model,
                'tour_info' => $tour_info,
                'p1' => $p1,
                'p2' => $p2,
            ]);
        }
    }

    /**
     * Deletes an existing Itinerary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $tour_id = $model->tour_id;
        $tour_info = Tour::find()->where(['id' => $tour_id])->one();
        $model->delete();

        $to_route = 'tour/update';
        if($tour_info['type'] == TOUR_TYPE_GROUP)
        {
            $to_route = 'group-tour/update';
        }
        return $this->redirect([$to_route, 'id' => $tour_id]);
    }

    /**
     * Finds the Itinerary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Itinerary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itinerary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
