<?php

namespace backend\controllers;

use Yii;
use common\models\UploadedFiles;
use common\models\UploadedFilesSearch;
use common\models\FileUse;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
                    $file_path = UploadedFiles::uploadFile($file);
                    if ($file_path)
                    {
                        $model->size = $file->size;
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
                    $file_path = UploadedFiles::uploadFile($file);
                    if ($file_path)
                    {
                        $model->size = $file->size;
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

    public function actionAsyncFiles()
    {
        $name = Yii::$app->request->post('name');
        $type = Yii::$app->request->post('type');
        $cid = Yii::$app->request->post('cid');
        // 如果没有商品图或者商品id非真，返回空

        if (empty($_FILES)) {
            echo '{}';
            return;
        }

        foreach ($_FILES as $file_item) {
            $arr_file = array();
            if (!empty($file_item) && is_array($file_item))
            {
                foreach ($file_item as $fname => $fvalue) {
                    if ($fname == 'name') {
                        $arr_file['name'] = $fvalue['images'];
                    }
                    elseif ($fname == 'tmp_name') {
                        $arr_file['tmp_name'] = $fvalue['images'];
                    }
                    elseif ($fname == 'size') {
                        $arr_file['size'] = $fvalue['images'];
                    }
                    elseif ($fname == 'type') {
                        $arr_file['type'] = $fvalue['images'];
                    }
                    elseif ($fname == 'error') {
                        $arr_file['error'] = $fvalue['images'];
                    }
                }
            }
        }

        if (!empty($arr_file)) {
            // 上传之后的图是可以进行删除操作的，我们为每一个商品成功的商品图指定删除操作的地址
            
            // 调用图片接口上传后返回的图片地址，注意是可访问到的图片地址哦
            $file_path = UploadedFiles::uploadFile($arr_file);
            $key = 0;
            if ($file_path) {
                // 保存图片信息
                $pathinfo = pathinfo($arr_file['name']);
                $model = new UploadedFiles();
                $model->title = $pathinfo['filename'];
                $model->path = $file_path;
                $model->org_name = $arr_file['name'];
                $model->size = $arr_file['size'];
                $fid = 0;
                if ($model->save(false)) {
                    $fid = $model->id;
                    $fu_model = new FileUse();
                    $fu_model->type = $type;
                    $fu_model->fid = $fid;
                    $fu_model->cid = $cid;
                    if ($fu_model->save(false))
                    {
                        $key = $fu_model->id;
                        $del_url = '/uploaded-files/del-file-use';
                    }
                }
            }
            // 这是一些额外的其他信息，如果你需要的话
            // $pathinfo = pathinfo($file_path);
            // $caption = $pathinfo['basename'];
            // $size = $_FILES['Banner']['size']['banner_url'][$i];

            $file_path_s = Yii::$app->params['uploads_url'] . UploadedFiles::getSize($file_path, 's');
            $p1[] = $file_path_s;
            $p2[] = ['url' => $del_url, 'key' => $key, 'path' => $file_path_s];
        }


        // 返回上传成功后的商品图信息
        echo json_encode([
            'initialPreview' => $p1, 
            'initialPreviewConfig' => $p2,   
            'append' => true,
        ]);
        return;
    }

    public function actionDelFileUse()
    {
        $fu_id = Yii::$app->request->post('key');
        if (!empty($fu_id))
        {
            $model = FileUse::findOne($fu_id)->delete();
            echo '{}';
            return;
        }
    }

    /*
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
    */
}
