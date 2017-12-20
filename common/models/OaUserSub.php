<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_user_sub".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $sub_id
 */
class OaUserSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_user_sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sub_id'], 'required'],
            [['user_id', 'sub_id'], 'integer'],
            [['user_id', 'sub_id'], 'unique', 'targetAttribute' => ['user_id', 'sub_id'], 'message' => 'The combination of User Name and Sub User Name has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User Name'),
            'sub_id' => Yii::t('app', 'Sub User Name'),
        ];
    }
}
