<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_daily_cost_subtype".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 */
class OaDailyCostSubtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_daily_cost_subtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name'], 'required'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
        ];
    }
}
