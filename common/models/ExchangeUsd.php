<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exchange_usd".
 *
 * @property string $code
 * @property string $rate
 * @property string $update_time
 */
class ExchangeUsd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange_usd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'rate'], 'required'],
            [['rate'], 'number'],
            [['update_time'], 'safe'],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Currency'),
            'rate' => Yii::t('app', 'Rate CNY'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public static function convertCurrency($currency , $limit)
    {
        if ($currency == 'CNY') {
            return $limit;
        }

        $cache = Yii::$app->cache;
        $cache_key = 'RATE_CNY_'.$currency;
        $rate = $cache->get($cache_key);
        if (empty($rate)) {
            $ret = self::findOne($currency);
            if ($ret) {
                $rate = $ret['rate'];
                $cache->set($cache_key, $rate, 60*5); 
                return round(($limit / $rate), 0);
            }
        }
        else
        {
            return round(($limit * $rate), 0);
        }
        return false;
    }

}
