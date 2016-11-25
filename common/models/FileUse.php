<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "file_use".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $cid
 * @property integer $fid
 * @property string $create_time
 */
class FileUse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_use';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'cid', 'fid'], 'required'],
            [['type', 'cid', 'fid'], 'integer'],
            [['create_time'], 'safe'],
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
            'cid' => Yii::t('app', 'Cid'),
            'fid' => Yii::t('app', 'Fid'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }
}
