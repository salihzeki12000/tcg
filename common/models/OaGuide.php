<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_guide".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $rating
 * @property string $language
 * @property string $daily_price
 * @property integer $city_id
 * @property integer $agency
 * @property string $contact_info
 * @property string $identity_bank_info
 * @property string $cl_english
 * @property string $note
 */
class OaGuide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_guide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'language', 'city_id'], 'required'],
            [['rating', 'city_id', 'agency'], 'integer'],
            [['daily_price'], 'number'],
            [['contact_info', 'identity_bank_info', 'cl_english', 'note', 'email'], 'string'],
            [['name', 'email', 'language'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['name'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Guide ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'rating' => Yii::t('app', 'Rating'),
            'language' => Yii::t('app', 'Language'),
            'daily_price' => Yii::t('app', 'Daily Price'),
            'city_id' => Yii::t('app', 'City'),
            'agency' => Yii::t('app', 'Agency'),
            'contact_info' => Yii::t('app', 'Contact Info'),
            'identity_bank_info' => Yii::t('app', 'Identity & Bank Info'),
            'cl_english' => Yii::t('app', 'CL-English'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
