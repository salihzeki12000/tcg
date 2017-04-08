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
 * @property string $update_time
 * @property string $note
 * @property string $donation
 */
class FormCard extends \yii\db\ActiveRecord
{
    public $secretKey = SECRET_SECRET_KEY;
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
            [['card_type', 'client_name', 'name_on_card', 'card_number', 'expiry_month', 'expiry_year', 'amount_to_bill', 'billing_address', 'contact_phone', 'email', 'travel_agent', 'tour_date'], 'required' , 'message' => Yii::t('app', 'Required')],
            [['card_number', 'status'], 'number'],
            [['card_number', 'amount_to_bill', 'donation'], 'string', 'max' => 18],
            [['note'], 'string'],
            ['card_security_code', 'integer'],
            ['card_security_code', 'string', 'max' => 6],
            [['create_time'], 'safe'],
            [['card_type'], 'string', 'max' => 20],
            [['client_name', 'name_on_card', 'contact_phone', 'card_holder_email', 'travel_agent'], 'string', 'max' => 28],
            [['email'], 'string', 'max' => 50],
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
            'update_time' => Yii::t('app', 'Update time'),
            'note' => Yii::t('app', 'note'),
            'donation' => Yii::t('app', 'Donate to Animals Asia'),
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            // ...custom code here...
            $secretKey = $this->secretKey;

            $this->card_number = base64_encode(\yii::$app->security->encryptByPassword($this->card_number, $secretKey));
            $this->card_security_code = base64_encode(\yii::$app->security->encryptByPassword($this->card_security_code, $secretKey));
            $this->expiry_month = base64_encode(\yii::$app->security->encryptByPassword($this->expiry_month, $secretKey));
            $this->expiry_year = base64_encode(\yii::$app->security->encryptByPassword($this->expiry_year, $secretKey));
            $this->billing_address = base64_encode(\yii::$app->security->encryptByPassword($this->billing_address, $secretKey));
            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        if (Yii::$app->controller->id == 'form-card' && Yii::$app->controller->action->id != 'index') {
            $secretKey = $this->secretKey;
            $this->card_number = \yii::$app->security->decryptByPassword(base64_decode($this->card_number),$secretKey);
            $this->card_security_code = \yii::$app->security->decryptByPassword(base64_decode($this->card_security_code),$secretKey);
            $this->expiry_month = \yii::$app->security->decryptByPassword(base64_decode($this->expiry_month),$secretKey);
            $this->expiry_year = \yii::$app->security->decryptByPassword(base64_decode($this->expiry_year),$secretKey);
            $this->billing_address = \yii::$app->security->decryptByPassword(base64_decode($this->billing_address),$secretKey);
        }
        parent::afterFind();
    }

}
