<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property integer $city_id
 * @property string $pic_s
 * @property string $overview
 * @property string $rec_type
 * @property integer $status
 * @property integer $keywords
 * @property string $create_time
 * @property string $update_time
 * @property string $url_id
 */
class Album extends \yii\db\ActiveRecord
{
    public $image;
    public $images;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        $table_name = 'album';
        $languages = Yii::$app->urlManager->languages;
        if (in_array(Yii::$app->language, $languages) && Yii::$app->language != Yii::$app->sourceLanguage) {
            return $table_name . '_' . Yii::$app->language;
        }
        return $table_name;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'city_id'], 'required'],
            [['type', 'city_id', 'status', 'priority'], 'integer'],
            [['overview', 'url_id'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'pic_s', 'keywords'], 'string', 'max' => 255],
            [['rec_type'], 'string', 'max' => 50],
            [['name'],'match','pattern'=>'/^[A-Za-z0-9_\'\s]+$/','message'=>'Name does not conform to the requirements'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'city_id' => Yii::t('app', 'City'),
            'pic_s' => Yii::t('app', 'Pic S'),
            'overview' => Yii::t('app', 'Overview'),
            'rec_type' => Yii::t('app', 'Recommendation'),
            'status' => Yii::t('app', 'Status'),
            'keywords' => Yii::t('app', 'Keywords'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'priority' => Yii::t('app', 'Priority'),
        ];
    }
}
