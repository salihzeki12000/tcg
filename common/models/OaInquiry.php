<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_inquiry".
 *
 * @property integer $id
 * @property string $create_time
 * @property string $update_time
 * @property string $inquiry_source
 * @property string $language
 * @property string $priority
 * @property string $agent
 * @property string $co_agent
 * @property integer $tour_type
 * @property string $group_type
 * @property string $organization
 * @property string $country
 * @property integer $number_of_travelers
 * @property string $traveler_info
 * @property string $tour_start_date
 * @property string $tour_end_date
 * @property string $cities
 * @property string $contact
 * @property string $email
 * @property string $other_contact_info
 * @property string $original_inquiry
 * @property string $follow_up_record
 * @property string $tour_schedule_note
 * @property string $other_note
 * @property string $estimated_cny_amount
 * @property string $probability
 * @property string $inquiry_status
 * @property integer $close
 * @property string $close_report
 * @property string $task_remind
 * @property string $task_remind_date
 * @property integer  $creator
 */
class OaInquiry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_inquiry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['original_inquiry', 'agent'], 'required'],
            [['tour_type', 'number_of_travelers', 'close', 'agent', 'co_agent', 'creator'], 'integer'],
            [['organization', 'traveler_info', 'other_contact_info', 'original_inquiry', 'follow_up_record', 'tour_schedule_note', 'other_note', 'close_report', 'task_remind_date', 'task_remind'], 'string'],
            [['estimated_cny_amount'], 'number'],
            [['inquiry_source', 'language', 'priority', 'group_type', 'country', 'tour_start_date', 'tour_end_date', 'contact', 'email', 'probability', 'inquiry_status', 'task_remind_date', 'task_remind'], 'string', 'max' => 255],
            [['cities'], 'string', 'max' => 1024],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Inquiry ID'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'inquiry_source' => Yii::t('app', 'Inquiry Source'),
            'language' => Yii::t('app', 'Inquiry Language'),
            'priority' => Yii::t('app', 'Priority'),
            'agent' => Yii::t('app', 'Agent'),
            'co_agent' => Yii::t('app', 'Co-Agent'),
            'tour_type' => Yii::t('app', 'Tour Type'),
            'group_type' => Yii::t('app', 'Group Type'),
            'organization' => Yii::t('app', 'Name of Organization(for student or MICE tour only)'),
            'country' => Yii::t('app', 'Country of Residence'),
            'number_of_travelers' => Yii::t('app', 'Number of Travelers'),
            'traveler_info' => Yii::t('app', 'Traveler\'s Detail Info'),
            'tour_start_date' => Yii::t('app', 'Tour Start Date'),
            'tour_end_date' => Yii::t('app', 'Tour End Date'),
            'cities' => Yii::t('app', 'Cities'),
            'contact' => Yii::t('app', 'Contact Person'),
            'email' => Yii::t('app', 'Contact Email'),
            'other_contact_info' => Yii::t('app', 'Other Contact Info'),
            'original_inquiry' => Yii::t('app', 'Original Inquiry'),
            'follow_up_record' => Yii::t('app', 'Follow Up Record'),
            'tour_schedule_note' => Yii::t('app', 'Tour Schedule Note'),
            'other_note' => Yii::t('app', 'Other Note'),
            'estimated_cny_amount' => Yii::t('app', 'Estimated Tour Price'),
            'probability' => Yii::t('app', 'Probability'),
            'inquiry_status' => Yii::t('app', 'Inquiry Status'),
            'close' => Yii::t('app', 'Close'),
            'close_report' => Yii::t('app', 'Close Report'),
            'task_remind' => Yii::t('app', 'Task Remind'),
            'task_remind_date' => Yii::t('app', 'Task Remind Date'),
            'creator' => Yii::t('app', 'Creator'),
        ];
    }
}
