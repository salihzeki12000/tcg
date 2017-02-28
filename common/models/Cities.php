<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $pic_s
 * @property string $pic_l
 * @property string $introduction
 * @property string $food
 * @property string $rec_type
 * @property string $vr
 * @property string $create_time
 * @property string $update_time
 * @property string $url_id
 */
class Cities extends \yii\db\ActiveRecord
{

    public $image;
    public $images;
    public $sel;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        $table_name = 'cities';
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
            [['name', 'status'], 'required'],
            [['status', 'priority'], 'integer'],
            [['introduction', 'food', 'url_id'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'rec_type'], 'string', 'max' => 100],
            [['pic_s'], 'string', 'max' => 255],
            [['vr'], 'string', 'max' => 512],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png'],
            [['name'],'match','pattern'=>'/^[A-Za-z0-9_\'\s\|]+$/','message'=>'Name does not conform to the requirements'],

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
            'status' => Yii::t('app', 'Status'),
            'pic_s' => Yii::t('app', 'Title Image（540 x 340 pixels）'),
            'introduction' => Yii::t('app', 'Introduction'),
            'food' => Yii::t('app', 'Food'),
            'rec_type' => Yii::t('app', 'Recommendation'),
            'vr' => Yii::t('app', 'Vr'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'image' => Yii::t('app', 'Title Image （540 x 340 pixels）'),
            'images' => Yii::t('app', 'Images （1280 x 320 pixels）'),
            'priority' => Yii::t('app', 'Priority'),
        ];
    }
}
