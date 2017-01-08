<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property integer $sub_type
 * @property string $content
 * @property integer $status
 * @property integer $keywords
 * @property string $create_time
 * @property string $update_time
 */
class Article extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        $table_name = 'article';
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
            [['title', 'type'], 'required'],
            [['type', 'sub_type', 'status', 'priority'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['title','pic_s', 'keywords'], 'string', 'max' => 255],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png'],
            [['title'],'match','pattern'=>'/^[A-Za-z0-9_\'\s\-\?]+$/','message'=>'Title does not conform to the requirements'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'type' => Yii::t('app', 'Type'),
            'sub_type' => Yii::t('app', 'Sub Type'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'keywords' => Yii::t('app', 'Keywords'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'priority' => Yii::t('app', 'Priority'),
        ];
    }
}
