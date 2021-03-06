<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_book_cost".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $create_time
 * @property string $updat_time
 * @property integer $creator
 * @property integer $type
 * @property integer $fid
 * @property string $start_date
 * @property string $end_date
 * @property string $cl_info
 * @property integer $need_to_pay
 * @property string $cny_amount
 * @property string $due_date_for_pay
 * @property integer $pay_status
 * @property string $confirmed_amount
 * @property string $pay_date
 * @property string $pay_amount
 * @property integer $pay_method
 * @property string $transaction_fee
 * @property string $transaction_note
 * @property string $book_status
 * @property string $book_date
 * @property string $note
 */
class OaBookCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_book_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['tour_id', 'type'], 'required'],
            [['tour_id', 'creator', 'type', 'fid', 'need_to_pay', 'pay_status', 'pay_method'], 'integer'],
            ['transaction_fee', 'number'],
            [['create_time', 'updat_time'], 'safe'],
            [['cl_info', 'transaction_note', 'note'], 'string'],
            [['cny_amount', 'pay_amount', 'confirmed_amount'], 'number'],
            [['book_date'], 'string', 'max' => 10],
            [['start_date', 'end_date', 'due_date_for_pay', 'pay_date', 'book_status'], 'string', 'max' => 255],
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
            'updat_time' => Yii::t('app', 'Update Time'),
            'creator' => Yii::t('app', 'Creator'),
            'type' => Yii::t('app', 'Type'),
            'fid' => Yii::t('app', 'Name'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'cl_info' => Yii::t('app', 'CL Info'),
            'need_to_pay' => Yii::t('app', 'Need to Pay'),
            'cny_amount' => Yii::t('app', 'Estimated Amount (CNY)'),
            'due_date_for_pay' => Yii::t('app', 'Due Date'),
            'pay_status' => Yii::t('app', 'Pay Status'),
            'confirmed_amount' => Yii::t('app', 'Confirmed Amount (CNY)'),
            'pay_date' => Yii::t('app', 'Accounting Date'),
            'pay_amount' => Yii::t('app', 'Accounting Amount (CNY)'),
            'pay_method' => Yii::t('app', 'Pay Method'),
            'transaction_fee' => Yii::t('app', 'Transaction Fee'),
            'transaction_note' => Yii::t('app', 'Transaction Note'),
            'book_status' => Yii::t('app', 'Book Status'),
            'book_date' => Yii::t('app', 'Book Date'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
