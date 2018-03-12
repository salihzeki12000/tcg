<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_payment".
 *
 * @property integer $id
 * @property integer $inquiry_id
 * @property integer $tour_id
 * @property string $create_time
 * @property string $update_time
 * @property string $payer
 * @property integer $payer_type
 * @property string $type
 * @property string $cny_amount
 * @property string $due_date
 * @property integer $pay_method
 * @property string $status
 * @property string $confirmed_amount
 * @property string $receit_account
 * @property string $receit_cny_amount
 * @property string $transaction_fee
 * @property string $receit_date
 * @property string $cc_note_signing
 * @property string $transaction_note
 * @property string $note
 */
class OaPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payer', 'cny_amount', 'due_date', 'pay_method', 'type', 'payer_type'], 'required'],
            [['tour_id'], 'required', 'when' => function ($model) {
		        return $model->inquiry_id == '';
		    }, 'whenClient' => "function (attribute, value) {
					return $('#oapayment-inquiry_id').val() == ''; }"
			],
            [['inquiry_id'], 'required', 'when' => function ($model) {
		        return $model->tour_id == '';
		    }, 'whenClient' => "function (attribute, value) {
					return $('#oapayment-tour_id').val() == ''; }"
			],
            [['inquiry_id', 'tour_id', 'pay_method'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['cny_amount', 'confirmed_amount', 'receit_cny_amount', 'transaction_fee', 'status'], 'number'],
            [['note', 'transaction_note'], 'string'],
            [['payer', 'type', 'due_date', 'receit_account', 'receit_date', 'cc_note_signing'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'inquiry_id' => Yii::t('app', 'Inquiry ID'),
            'tour_id' => Yii::t('app', 'Tour ID'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'payer' => Yii::t('app', 'Guest Name'),
            'payer_type' => Yii::t('app', 'Payer'),
            'type' => Yii::t('app', 'Type'),
            'cny_amount' => Yii::t('app', 'Amount (CNY)'),
            'due_date' => Yii::t('app', 'Due Date'),
            'pay_method' => Yii::t('app', 'Pay Method'),
            'status' => Yii::t('app', 'Pay Status'),
            'confirmed_amount' => Yii::t('app', 'Confirmed Amount (CNY)'),
            'receit_account' => Yii::t('app', 'Receipt Account'),
            'receit_cny_amount' => Yii::t('app', 'Accounting Amount (CNY)'),
            'transaction_fee' => Yii::t('app', 'Transaction Fee (CNY)'),
            'receit_date' => Yii::t('app', 'Accounting Date'),
            'cc_note_signing' => Yii::t('app', 'CC Note Signing'),
            'transaction_note' => Yii::t('app', 'Transaction Note'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
