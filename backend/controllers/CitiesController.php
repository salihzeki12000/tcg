<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use common\models\Cities;
use common\models\CitiesSearch;
use common\models\UploadedFiles;
use common\models\UploadedFilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CitiesController implements the CRUD actions for Cities model.
 */
class CitiesController extends Controller
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
     * Lists all Cities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cities model.
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
     * Creates a new Cities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cities();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->create_time = date('Y-m-d H:i:s',time());
            if (Yii::$app->language == Yii::$app->sourceLanguage) {
                $model->url_id = strtolower(str_replace(' ', '-', $model->name));
            }
            if($model->save()){
                return $this->redirect(['update', 'id' => $model->id]);   
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $p1 = $p2 = [];
        if ($model->load(Yii::$app->request->post())) {

            if (is_array($_POST['Cities']['rec_type'])) {
                $model->rec_type = join(',', $_POST['Cities']['rec_type']);
            }

            $file = \yii\web\UploadedFile::getInstance($model, 'image');
            if (!empty($file))
            {
                $tmp_name = $file->tempName;
                if ($tmp_name) {
                    $file_path = UploadedFiles::uploadFile($file);
                    if ($file_path)
                    {
                        $model->pic_s = $file_path;
                    }
                }
            }
            $model->update_time = date('Y-m-d H:i:s',time());
            if (Yii::$app->language == Yii::$app->sourceLanguage) {
                $model->url_id = strtolower(str_replace(' ', '-', $model->name));
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->rec_type = explode(',', $model->rec_type);

            $ftype = BIZ_TYPE_CITIES;
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
                'p1' => $p1,
                'p2' => $p2,
            ]);
        }
    }

    /**
     * Deletes an existing Cities model.
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
     * Finds the Cities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
