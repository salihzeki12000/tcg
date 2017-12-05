<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_city".
 *
 * @property integer $id
 * @property string $name
 * @property string $guide
 */
class OaCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['guide'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'City Name'),
            'guide' => Yii::t('app', 'Guide'),
        ];
    }
}
