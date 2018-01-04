<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_feedback".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $language
 * @property string $create_time
 * @property string $comment_itinerary
 * @property string $comment_meals
 * @property string $comment_service
 * @property string $how_found_us
 * @property string $why_chose_us
 * @property string $rate
 * @property string $suggestions
 * @property string $client_name
 * @property string $client_email
 * @property string $agent
 */
class OaFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_itinerary', 'comment_meals', 'comment_service', 'how_found_us', 'why_chose_us', 'rate', 'suggestions', 'client_name', 'client_email', 'agent'], 'required'],
            [['tour_id'], 'integer'],
            [['create_time'], 'safe'],
            [['comment_itinerary', 'comment_meals', 'comment_service', 'suggestions'], 'string'],
            [['language'], 'string', 'max' => 15],
            [['how_found_us', 'why_chose_us', 'client_name', 'client_email'], 'string', 'max' => 255],
            [['rate'], 'string', 'max' => 15],
            [['agent'], 'string', 'max' => 28],
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
            'language' => Yii::t('app', 'Language'),
            'create_time' => Yii::t('app', 'Create Time'),
            'comment_itinerary' => Yii::t('app', 'How do you comment your itinerary? Was there any sight or activity you would have skipped?'),
            'comment_meals' => Yii::t('app', 'How do you comment the meals included in your tour package?'),
            'comment_service' => Yii::t('app', 'How do you comment the service of your travel agent?'),
            'how_found_us' => Yii::t('app', 'How did you find out about The China Guide?'),
            'why_chose_us' => Yii::t('app', 'Why did you choose us?'),
            'rate' => Yii::t('app', 'Overall how would you rate your trip?'),
            'suggestions' => Yii::t('app', 'Do you have any suggestions for us?'),
            'client_name' => Yii::t('app', 'Your name'),
            'client_email' => Yii::t('app', 'Your email'),
            'agent' => Yii::t('app', 'Your travel agent'),
        ];
    }
}
