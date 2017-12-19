<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_guide_expense".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property integer $guide_id
 * @property string $start_date
 * @property string $end_date
 * @property string $guide_service_fee
 * @property string $amount_spendings
 * @property string $details_spendings
 * @property string $cash_collect
 * @property string $notes
 */
class OaGuideExpense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_guide_expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id', 'guide_id', 'start_date', 'end_date', 'guide_service_fee', 'amount_spendings', 'details_spendings', 'cash_collect', 'notes'], 'required'],
            [['tour_id', 'guide_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['guide_service_fee', 'amount_spendings'], 'number'],
            [['details_spendings', 'cash_collect', 'notes'], 'string'],
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
            'guide_id' => Yii::t('app', 'Guide ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'guide_service_fee' => Yii::t('app', 'Guide Service Fee'),
            'amount_spendings' => Yii::t('app', 'Amount Spendings'),
            'details_spendings' => Yii::t('app', 'Details Spendings'),
            'cash_collect' => Yii::t('app', 'Cash Collect'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }
}
