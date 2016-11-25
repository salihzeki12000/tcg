<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $status
 * @property string $themes
 * @property string $cities
 * @property integer $cities_count
 * @property integer $priority
 * @property string $tour_length
 * @property integer $exp_num
 * @property string $price_cny
 * @property string $price_usd
 * @property string $overview
 * @property string $best_season
 * @property string $pic_map
 * @property string $pic_title
 * @property string $inclusion
 * @property string $exclusion
 * @property string $tips
 * @property string $keywords
 * @property string $link_tour
 * @property string $create_time
 * @property string $update_time
 */
class Tour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'status', 'themes', 'cities'], 'required'],
            [['status', 'cities_count', 'priority', 'exp_num'], 'integer'],
            [['tour_length', 'price_cny', 'price_usd'], 'number'],
            [['overview', 'inclusion', 'exclusion', 'tips'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'themes', 'cities', 'best_season', 'pic_map', 'pic_title', 'link_tour'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 20],
            [['keywords'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'status' => Yii::t('app', 'Status'),
            'themes' => Yii::t('app', 'Themes'),
            'cities' => Yii::t('app', 'Cities'),
            'cities_count' => Yii::t('app', 'Cities Count'),
            'priority' => Yii::t('app', 'Priority'),
            'tour_length' => Yii::t('app', 'Tour Length'),
            'exp_num' => Yii::t('app', 'Exp Num'),
            'price_cny' => Yii::t('app', 'Price Cny'),
            'price_usd' => Yii::t('app', 'Price Usd'),
            'overview' => Yii::t('app', 'Overview'),
            'best_season' => Yii::t('app', 'Best Season'),
            'pic_map' => Yii::t('app', 'Pic Map'),
            'pic_title' => Yii::t('app', 'Pic Title'),
            'inclusion' => Yii::t('app', 'Inclusion'),
            'exclusion' => Yii::t('app', 'Exclusion'),
            'tips' => Yii::t('app', 'Tips'),
            'keywords' => Yii::t('app', 'Keywords'),
            'link_tour' => Yii::t('app', 'Link Tour'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
}
