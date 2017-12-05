<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_other_cost".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_id
 * @property string $contact_person_info
 * @property string $bank_info
 * @property string $note
 */
class OaOtherCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_other_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['city_id'], 'integer'],
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
            'contact_person_info' => Yii::t('app', 'Contact Person & Info'),
            'bank_info' => Yii::t('app', 'Bank Info'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
