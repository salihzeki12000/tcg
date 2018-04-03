<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_voucher".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $code
 * @property integer $value
 * @property integer $used
 */
 
class OaVoucher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id', 'code', 'value', 'used'], 'required'],
            [['tour_id', 'value', 'used'], 'number'],
            [['code'], 'string', 'max' => 20],
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
            'code' => Yii::t('app', 'Code'),
            'value' => Yii::t('app', 'Value'),
            'used' => Yii::t('app', 'Used'),
        ];
    }
    
    public function generateUniqueRandomString($attribute, $length = 32)
    {
		$randomString = str_replace(array('-', '_'), 'A', strtoupper(Yii::$app->getSecurity()->generateRandomString($length)));
				
		if(!$this->findOne([$attribute => $randomString])):
			return $randomString;
		else:
			return $this->generateUniqueRandomString($attribute, $length);
		endif;
	}
}

