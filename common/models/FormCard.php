<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form_card".
 *
 * @property integer $id
 * @property string $card_type
 * @property string $client_name
 * @property string $name_on_card
 * @property string $card_number
 * @property integer $card_security_code
 * @property string $expiry_month
 * @property string $expiry_year
 * @property string $amount_to_bill
 * @property string $billing_address
 * @property string $contact_phone
 * @property string $email
 * @property string $card_holder_email
 * @property string $travel_agent
 * @property string $tour_date
 * @property string $create_time
 * @property string $agent_mail
 * @property integer $status
 */
class FormCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_type', 'client_name', 'name_on_card', 'card_number', 'card_security_code', 'expiry_month', 'expiry_year', 'amount_to_bill', 'billing_address', 'contact_phone', 'email', 'travel_agent', 'tour_date'], 'required' , 'message' => Yii::t('app', 'Required')],
            [['card_number', 'amount_to_bill', 'status'], 'number'],
            [['card_number', 'amount_to_bill'], 'string', 'max' => 18],
            ['card_security_code', 'integer'],
            ['card_security_code', 'string', 'max' => 6],
            [['create_time'], 'safe'],
            [['card_type'], 'string', 'max' => 20],
            [['client_name', 'name_on_card', 'contact_phone', 'email', 'card_holder_email', 'travel_agent'], 'string', 'max' => 28],
            [['expiry_month', 'expiry_year'], 'string', 'max' => 10],
            [['billing_address','agent_mail'], 'string', 'max' => 50],
            [['tour_date'], 'string', 'max' => 12],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'card_type' => Yii::t('app', 'Card type'),
            'client_name' => Yii::t('app', 'Your full name'),
            'name_on_card' => Yii::t('app', 'Name on card'),
            'card_number' => Yii::t('app', 'Card number'),
            'card_security_code' => Yii::t('app', 'Card security code'),
            'expiry_month' => Yii::t('app', 'Expiry date Month'),
            'expiry_year' => Yii::t('app', 'Expiry date Year'),
            'amount_to_bill' => Yii::t('app', 'Amount to bill'),
            'billing_address' => Yii::t('app', 'Billing address'),
            'contact_phone' => Yii::t('app', 'Your phone number'),
            'email' => Yii::t('app', 'Your email'),
            'card_holder_email' => Yii::t('app', 'Card holder\'s email'),
            'travel_agent' => Yii::t('app', 'Your travel agent'),
            'tour_date' => Yii::t('app', 'Your tour start date'),
            'create_time' => Yii::t('app', 'Create Time'),
            'agent_mail' => Yii::t('app', 'Agent mail'),
            'status' => Yii::t('app', 'status'),
        ];
    }
}
