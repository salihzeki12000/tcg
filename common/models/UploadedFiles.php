<?php

namespace common\models;

use Yii;

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
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    static public function getSize($file_path, $size='')
    {
        if (in_array($size, array('s', 'm')))
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
}
