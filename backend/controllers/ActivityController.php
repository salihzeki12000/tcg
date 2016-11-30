<?php

namespace backend\controllers;

use Yii;
use common\models\Album;
use common\models\AlbumSearch;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlbumController implements the CRUD actions for Album model.
 */
class ActivityController extends Controller
{
    public $album_type = ALBUM_TYPE_ACTIVITY;
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
     * Lists all Album models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlbumSearch();
        $_GET['AlbumSearch']['type'] = $this->album_type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/album/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Album model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/album/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Album model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Album();

        if ($model->load(Yii::$app->request->post())) {

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

            if ($model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            return $this->render('/album/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Album model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $p1 = $p2 = [];

        if ($model->load(Yii::$app->request->post())) {
            if (is_array($_POST['Album']['rec_type'])) {
                $model->rec_type = join(',', $_POST['Album']['rec_type']);
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
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->rec_type = explode(',', $model->rec_type);

            $ftype = Yii::$app->params['biz_type']['album'];
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

            return $this->render('/album/update', [
                'model' => $model,
                'p1' => $p1,
                'p2' => $p2,
            ]);
        }
    }

    /**
     * Deletes an existing Album model.
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
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function render($view, $params = [])
    {
        $params['type'] = $this->album_type;
        return parent::render($view, $params);
    }

}
