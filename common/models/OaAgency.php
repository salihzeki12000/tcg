<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_agency".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_id
 * @property integer $rating
 * @property string $contact_person_info
 * @property string $bank_info
 * @property string $note
 */
class OaAgency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['city_id', 'rating'], 'integer'],
            [['contact_person_info', 'bank_info', 'note'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'rating' => Yii::t('app', 'Rating'),
            'contact_person_info' => Yii::t('app', 'Contact Person & Info'),
            'bank_info' => Yii::t('app', 'Bank Info'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
