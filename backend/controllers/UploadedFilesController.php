<?php

namespace backend\controllers;

use Yii;
use common\models\UploadedFiles;
use common\models\UploadedFilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use Imagine\Image\Box;
/**
 * UploadedFilesController implements the CRUD actions for UploadedFiles model.
 */
class UploadedFilesController extends Controller
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
     * Lists all UploadedFiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UploadedFilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UploadedFiles model.
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
     * Creates a new UploadedFiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UploadedFiles();

        if ($model->load(Yii::$app->request->post())) {            
            $file = \yii\web\UploadedFile::getInstance($model, 'image');
            if (!empty($file))
            {
                $model->org_name = $file->name;
                $tmp_name = $file->tempName;
                if ($tmp_name) {
                    $file_path = $this->uploadFile($file);
                    if ($file_path)
                    {
                        $model->path = $file_path;
                        if($model->save())
                        {
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                }
                else
                {
                    $msg = 'image upload failed';
                    throw new NotFoundHttpException($msg);
                }
            }
            return $this->render('create', ['model' => $model]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UploadedFiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {            
            $file = \yii\web\UploadedFile::getInstance($model, 'image');
            if (!empty($file))
            {
                $model->org_name = $file->name;
                $tmp_name = $file->tempName;
                if ($tmp_name) {
                    $file_path = $this->uploadFile($file);
                    if ($file_path)
                    {
                        $model->path = $file_path;
                        if($model->save())
                        {
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                }
            }
            return $this->render('create', ['model' => $model]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UploadedFiles model.
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
     * Finds the UploadedFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UploadedFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UploadedFiles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function uploadFile($file)
    {
        if (!empty($file))
        {
            if($file->size > 1024*1024*5)
            {
                $msg = 'image size more than 5Mb';
                throw new NotFoundHttpException($msg);
            }
            $tmp_name = $file->tempName;
            $time = time();
            $file_dir = date('Ym',$time) . '/' . date('d',$time);
            $server_dir = Yii::getAlias('@uploads') . '/' . $file_dir;
            if(!is_dir($server_dir))
            {
                mkdir($server_dir, 0755, true);
            }
            $file_name = uniqid();// . '.' . pathinfo($file->name,PATHINFO_EXTENSION);
            $file_path = $server_dir . '/' . $file_name;
            if ($tmp_name) {
                // $ret =  $file->saveAs($file_path);
                $newWidth = 1280; $newHeight = 2560;
                $ret = Image::getImagine()->open($tmp_name)->thumbnail(new Box($newWidth, $newHeight))
                ->save($file_path.'.jpg' , ['quality' => 90]);
                if ($ret)
                {
                    $newWidth = 720; $newHeight = 1440;
                    Image::getImagine()->open($tmp_name)->thumbnail(new Box($newWidth, $newHeight))
                    ->save($file_path.'_m.jpg' , ['quality' => 90]);

                    $newWidth = 360; $newHeight = 720;
                    Image::getImagine()->open($tmp_name)->thumbnail(new Box($newWidth, $newHeight))
                    ->save($file_path.'_s.jpg' , ['quality' => 90]);

                    return $file_dir . '/' . $file_name .'.jpg';
                }
            }
        }
        return false;
    }
}
