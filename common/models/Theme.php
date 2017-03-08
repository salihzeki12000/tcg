<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "theme".
 *
 * @property integer $id
 * @property string $name
 * @property string $use_ids
 * @property integer $priority
 * @property string $class_name
 * @property string $create_time
 * @property string $update_time
 * @property string $sync_time
 * @property string $url_id

 */
class Theme extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        $table_name = 'theme';
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
        $name_rule = [['name'], 'string', 'max' => 255];
        if (Yii::$app->language == Yii::$app->sourceLanguage) {
            $name_rule = [['name'],'match','pattern'=>'/^[A-Za-z0-9_\s]+$/','message'=>'Name does not conform to the requirements'];
        }
        return [
            [['name', 'use_ids'], 'required'],
            [['priority', 'status'], 'integer'],
            [['create_time', 'update_time', 'sync_time', 'url_id'], 'safe'],
            [['name', 'class_name'], 'string', 'max' => 50],
            [['use_ids'], 'string', 'max' => 255],
            [['use_ids'],'match','pattern'=>'/^(\d+[,])*(\d+)$/','message'=>'Name does not conform to the requirements'],
            $name_rule,

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
            'use_ids' => Yii::t('app', 'Use IDs'),
            'priority' => Yii::t('app', 'Priority'),
            'class_name' => Yii::t('app', 'Class Name'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'sync_time' => Yii::t('app', 'Sync Time'),
            'status' => Yii::t('app', 'Status'),
            'url_id' => Yii::t('app', 'Url Title'),
        ];
    }
}
