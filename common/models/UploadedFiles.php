<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "uploaded_files".
 *
 * @property integer $id
 * @property string $title
 * @property string $org_name
 * @property string $path
 * @property string $create_time
 * @property string $image
 */
class UploadedFiles extends \yii\db\ActiveRecord
{
    public $image;
    public $images;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploaded_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['create_time'], 'safe'],
            [['title'], 'string', 'max' => 255],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png'],
            //['images[]', 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'org_name' => Yii::t('app', 'Org Name'),
            'path' => Yii::t('app', 'Path'),
            'image' => Yii::t('app', 'Image'),
            'size' => Yii::t('app', 'Size'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    static public function getSize($file_path, $size='')
    {
        if (in_array($size, array('s', 'm', 'mob')))
        {
            $rindex = strrpos($file_path, '.jpg');
            if ($rindex)
            {
                $new_path = substr($file_path, 0, $rindex) . '_' . $size . '.jpg';
                return $new_path;
            }
        }
        return $file_path;
    }

    static public function uploadFile($file, &$fid=0)
    {
        $quality = 90;
        if (!empty($file))
        {
            $file_size = 0;
            $tmp_name = '';
            $org_name = '';
            if (is_array($file))
            {
                $file_size = $file['size'];
                $tmp_name = $file['tmp_name'];
                $org_name = $file['name'];
            }
            elseif (is_object($file))
            {
                $tmp_name = $file->tempName;
                $file_size = $file->size;
                $org_name = $file->name;
            }
            if($file_size > 1024*1024*5)
            {
                $msg = 'image size more than 5Mb';
                throw new NotFoundHttpException($msg);
            }
            $time = time();
            $file_dir = date('Ym',$time) . '/' . date('d',$time);
            $server_dir = Yii::getAlias('@uploads') . '/' . $file_dir;
            if(!is_dir($server_dir))
            {
                mkdir($server_dir, 0755, true);
            }
            $file_name = uniqid();
            $file_path = $server_dir . '/' . $file_name;
            $main_file = $file_path.'.jpg';
            $web_path  = $file_dir . '/' . $file_name .'.jpg';
            if ($tmp_name) {
                $newWidth = 2000; $newHeight = 2560;
                $ret = Image::getImagine()->open($tmp_name)->thumbnail(new Box($newWidth, $newHeight))
                ->save($main_file, ['quality' => $quality]);
                if ($ret){
                    $md5file = md5_file($main_file);
                    if (($ext_row = self::findOne(['md5'=>$md5file])) !== null) {
                        $fid = $ext_row->id;
                        unlink($main_file);
                        return $ext_row->path;
                    }
                    else{
                        $pathinfo = pathinfo($org_name);
                        $model = new UploadedFiles();
                        $model->title = str_replace('_', '\'', $pathinfo['filename']);
                        $model->path = $web_path;
                        $model->org_name = $org_name;
                        $model->size = $file_size;
                        $model->md5 = $md5file;
                        if ($model->save(false)) {
                            $fid = $model->id;
                        }
                    }
                }

                if ($ret)
                {
                    $newWidth = 720; $newHeight = 360;
                    Image::thumbnail($tmp_name, $newWidth , $newHeight)
                    ->save(Yii::getAlias($file_path.'_mob.jpg'), ['quality' => $quality]);

                    $newWidth = 720; $newHeight = 1440;
                    Image::getImagine()->open($tmp_name)->thumbnail(new Box($newWidth, $newHeight))
                    ->save($file_path.'_m.jpg' , ['quality' => $quality]);

                    $newWidth = 360; $newHeight = 720;
                    Image::getImagine()->open($tmp_name)->thumbnail(new Box($newWidth, $newHeight))
                    ->save($file_path.'_s.jpg' , ['quality' => $quality]);

                    return $web_path;
                }
            }
        }
        return false;
    }
}
