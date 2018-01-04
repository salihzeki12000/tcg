<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_payment".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $create_time
 * @property string $update_time
 * @property string $payer
 * @property string $type
 * @property string $cny_amount
 * @property string $due_date
 * @property string $pay_method
 * @property string $receit_account
 * @property string $receit_cny_amount
 * @property string $transaction_fee
 * @property string $receit_date
 * @property string $cc_note_signing
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
            [['tour_id', 'payer', 'cny_amount', 'due_date', 'pay_method', 'type'], 'required'],
            [['tour_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['cny_amount', 'receit_cny_amount', 'transaction_fee'], 'number'],
            [['note'], 'string'],
            [['payer', 'type', 'due_date', 'pay_method', 'receit_account', 'receit_date', 'cc_note_signing'], 'string', 'max' => 255],
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
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'payer' => Yii::t('app', 'Payer'),
            'type' => Yii::t('app', 'Type'),
            'cny_amount' => Yii::t('app', 'CNY Amount'),
            'due_date' => Yii::t('app', 'Due Date'),
            'pay_method' => Yii::t('app', 'Pay Method'),
            'receit_account' => Yii::t('app', 'Receipt Account'),
            'receit_cny_amount' => Yii::t('app', 'Receipt CNY Amount'),
            'transaction_fee' => Yii::t('app', 'Transaction Fee'),
            'receit_date' => Yii::t('app', 'Receipt Date'),
            'cc_note_signing' => Yii::t('app', 'CC Note Signing'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
