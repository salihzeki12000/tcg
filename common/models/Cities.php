<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $pic_s
 * @property string $pic_l
 * @property string $introduction
 * @property string $food
 * @property string $rec_type
 * @property string $vr
 * @property string $create_time
 * @property string $update_time
 */
class Cities extends \yii\db\ActiveRecord
{

    public $image;
    public $images;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            [['introduction', 'food'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'rec_type'], 'string', 'max' => 100],
            [['pic_s'], 'string', 'max' => 255],
            [['vr'], 'string', 'max' => 512],
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
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'pic_s' => Yii::t('app', 'Title Image'),
            'introduction' => Yii::t('app', 'Introduction'),
            'food' => Yii::t('app', 'Food'),
            'rec_type' => Yii::t('app', 'Recommendation'),
            'vr' => Yii::t('app', 'Vr'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'image' => Yii::t('app', 'Title Image'),
        ];
    }
}
