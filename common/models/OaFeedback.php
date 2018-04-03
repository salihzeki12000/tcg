<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_feedback".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $create_time
 * @property string $comment_itinerary
 * @property string $comment_meals
 * @property string $comment_service_agent
 * @property string $comment_service_guide_driver
 * @property string $why_chose_us
 * @property string $rate
 * @property string $suggestions
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
            [['comment_itinerary', 'comment_meals', 'comment_service_agent', 'rate', 'comment_service_guide_driver'], 'required', 'message' => Yii::t('app', 'Required')],
            [['tour_id'], 'integer'],
            [['create_time'], 'safe'],
            [['comment_itinerary', 'comment_meals', 'comment_service_agent', 'comment_service_guide_driver', 'suggestions'], 'string'],
            [['why_chose_us'], 'string', 'max' => 255],
            [['rate'], 'string', 'max' => 50],
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
            'create_time' => Yii::t('app', 'Create Time'),
            'comment_itinerary' => Yii::t('app', '1. Did your itinerary meet your expectations?'),
            'comment_meals' => Yii::t('app', '2. Did you enjoy the meals included in your tour package?'),
            'comment_service_guide_driver' => Yii::t('app', '3. How was the service provided by your guide(s) and driver(s)?'),
            'comment_service_agent' => Yii::t('app', '4. Were you satisfied with your communication with your travel specialist?'),
            'rate' => Yii::t('app', '5. Overall, how would you rate your trip?'),
            'why_chose_us' => Yii::t('app', '6. Why did you choose The China Guide?'),
            'suggestions' => Yii::t('app', '7. Do you have any other suggestions for us?'),
        ];
    }
}