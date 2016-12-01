<?php

namespace backend\controllers;

use Yii;
use common\models\Tour;
use common\models\TourSearch;
use common\models\UploadedFiles;
use common\models\Cities;
use common\models\Itinerary;
use common\models\ItinerarySearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * TourController implements the CRUD actions for Tour model.
 */
class TourController extends Controller
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
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TourSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $cities = ArrayHelper::map(Cities::find()->where(['id' => explode(',', $model->cities)])->all(), 'id', 'name');
        $model->cities = join(',', array_values($cities));
        $tour_themes = Yii::$app->params['tour_themes'];
        if (!empty($model->themes)) {
            $themes_ids = explode(',', $model->themes);
            $themes = array();
            if (!empty($themes_ids) && is_array($themes_ids)) {
                foreach ($themes_ids as $value) {
                    $themes[] = $tour_themes[$value];
                }
                $model->themes = join(',', array_values($themes));
            }
        }
        $months = Yii::$app->params['months'];
        if (!empty($model->best_season)) {
            $best_season_ids = explode(',', $model->best_season);
            $best_season = array();
            if (!empty($best_season_ids) && is_array($best_season_ids)) {
                foreach ($best_season_ids as $value) {
                    $best_season[] = $months[$value];
                }
                $model->best_season = join(',', array_values($best_season));
            }
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Tour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tour();

        if ($model->load(Yii::$app->request->post())) {
            if (is_array($_POST['Tour']['cities'])) {
                $model->cities = join(',', $_POST['Tour']['cities']);
                $model->cities_count = count($_POST['Tour']['cities']);
            }
            if (is_array($_POST['Tour']['themes'])) {
                $model->themes = join(',', $_POST['Tour']['themes']);
            }
            if (is_array($_POST['Tour']['rec_type'])) {
                $model->rec_type = join(',', $_POST['Tour']['rec_type']);
            }
            if($model->save())
            {
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tour model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $p1 = $p2 = [];

        if ($model->load(Yii::$app->request->post())) {
            if (is_array($_POST['Tour']['cities'])) {
                $model->cities = join(',', $_POST['Tour']['cities']);
                $model->cities_count = count($_POST['Tour']['cities']);
            }
            if (is_array($_POST['Tour']['themes'])) {
                $model->themes = join(',', $_POST['Tour']['themes']);
            }
            if (is_array($_POST['Tour']['best_season'])) {
                $model->best_season = join(',', $_POST['Tour']['best_season']);
            }
            if (is_array($_POST['Tour']['rec_type'])) {
                $model->rec_type = join(',', $_POST['Tour']['rec_type']);
            }

            $file = \yii\web\UploadedFile::getInstance($model, 'image');
            if (!empty($file))
            {
                $tmp_name = $file->tempName;
                if ($tmp_name) {
                    $file_path = UploadedFiles::uploadFile($file, 1);
                    if ($file_path)
                    {
                        $model->pic_title = $file_path;
                    }
                }
            }

            $file_map = \yii\web\UploadedFile::getInstance($model, 'map_image');
            if (!empty($file_map))
            {
                $tmp_name = $file_map->tempName;
                if ($tmp_name) {
                    $file_path = UploadedFiles::uploadFile($file_map);
                    if ($file_path)
                    {
                        $model->pic_map = $file_path;
                    }
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->cities = explode(',', $model->cities);
            $model->themes = explode(',', $model->themes);
            $model->best_season = explode(',', $model->best_season);
            $model->rec_type = explode(',', $model->rec_type);

            $ftype = BIZ_TYPE_TOUR;
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

            $_GET['sort'] = 'day';
            $_GET['tour_id'] = $id;
            $searchModel = new ItinerarySearch();
            $queryParams = Yii::$app->request->queryParams;
            unset($queryParams['id']);
            $dataProvider = $searchModel->search($queryParams);

            return $this->render('update', [
                'model' => $model,
                'p1' => $p1,
                'p2' => $p2,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Tour model.
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
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tour::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
