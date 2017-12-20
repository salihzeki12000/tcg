<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_hotel".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_id
 * @property integer $level
 * @property string $tripadvisor_link
 * @property integer $rating
 * @property string $rooms_prices
 * @property string $contact_person_info
 * @property string $bank_info
 * @property string $cl_english
 * @property string $note
 */
class OaHotel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_hotel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['city_id', 'rating', 'level'], 'integer'],
            [['rooms_prices', 'contact_person_info', 'bank_info', 'cl_english', 'note'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['tripadvisor_link'], 'string', 'max' => 512],
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
            'city_id' => Yii::t('app', 'City'),
            'level' => Yii::t('app', 'Level'),
            'tripadvisor_link' => Yii::t('app', 'Tripadvisor Link'),
            'rating' => Yii::t('app', 'Rating'),
            'rooms_prices' => Yii::t('app', 'Rooms & Prices'),
            'contact_person_info' => Yii::t('app', 'Contact Person & Info'),
            'bank_info' => Yii::t('app', 'Bank Info'),
            'cl_english' => Yii::t('app', 'CL-English'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
