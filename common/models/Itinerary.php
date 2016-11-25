<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "itinerary".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property integer $day
 * @property string $cities_name
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 */
class Itinerary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itinerary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id', 'day', 'cities_name'], 'required'],
            [['tour_id', 'day'], 'integer'],
            [['description'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['cities_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tour_id' => Yii::t('app', 'Tour ID'),
            'day' => Yii::t('app', 'Day'),
            'cities_name' => Yii::t('app', 'Cities Name'),
            'description' => Yii::t('app', 'Description'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
}
