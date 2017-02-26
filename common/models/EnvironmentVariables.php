<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "environment_variables".
 *
 * @property string $key
 * @property string $value
 */
class EnvironmentVariables extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'environment_variables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['key'], 'string', 'max' => 20],
            [['value'], 'string', 'max' => 1024],
            [['value'],'match','pattern'=>'/^\{[\s*"\w+":"A-Za-z0-9@.",*\s*]+\}$/','message'=>'Value does not conform to the requirements'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
