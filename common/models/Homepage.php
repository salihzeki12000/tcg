<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "homepage".
 *
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $description
 * @property string $pic_s
 * @property string $url
 * @property integer $priority
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class Homepage extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        $table_name = 'homepage';
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
            [['type', 'title'], 'required'],
            [['type', 'priority', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['description', 'pic_s', 'url'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'pic_s' => Yii::t('app', 'Pic S'),
            'url' => Yii::t('app', 'URL'),
            'priority' => Yii::t('app', 'Priority'),
            'status' => Yii::t('app', 'Status'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
}
