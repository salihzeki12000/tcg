<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_daily_cost".
 *
 * @property integer $id
 * @property string $create_time
 * @property integer $creator
 * @property integer $type
 * @property integer $sub_type
 * @property integer $amount
 * @property integer $pay_status
 * @property string $pay_date
 * @property string $notes
 */
 
class OaDailyCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_daily_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time'], 'safe'],
            [['creator', 'type', 'sub_type', 'amount', 'pay_status', 'pay_date'], 'required'],
            [['creator', 'type', 'sub_type', 'pay_status'], 'integer'],
            [['amount'], 'number'],
            [['notes'], 'string'],
            [['pay_date'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'create_time' => Yii::t('app', 'Create Time'),
            'creator' => Yii::t('app', 'Creator'),
            'type' => Yii::t('app', 'Type'),
            'sub_type' => Yii::t('app', 'Sub Type'),
            'amount' => Yii::t('app', 'Amount'),
            'pay_status' => Yii::t('app', 'Pay Status'),
            'pay_date' => Yii::t('app', 'Pay Date'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }
}