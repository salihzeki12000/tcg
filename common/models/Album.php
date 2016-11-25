<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property integer $city_id
 * @property string $pic_s
 * @property string $overview
 * @property integer $rec_type
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class Album extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'city_id'], 'required'],
            [['type', 'city_id', 'rec_type', 'status'], 'integer'],
            [['overview'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'pic_s'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'city_id' => Yii::t('app', 'City ID'),
            'pic_s' => Yii::t('app', 'Pic S'),
            'overview' => Yii::t('app', 'Overview'),
            'rec_type' => Yii::t('app', 'Rec Type'),
            'status' => Yii::t('app', 'Status'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
}