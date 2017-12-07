<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oa_tour".
 *
 * @property integer $id
 * @property integer $inquiry_id
 * @property string $create_time
 * @property string $update_time
 * @property string $inquiry_source
 * @property string $language
 * @property integer $vip
 * @property integer $agent
 * @property integer $co_agent
 * @property string $operator
 * @property integer $tour_type
 * @property string $group_type
 * @property string $country
 * @property string $organization
 * @property integer $number_of_travelers
 * @property string $traveler_info
 * @property string $tour_start_date
 * @property string $tour_end_date
 * @property string $cities
 * @property string $contact
 * @property string $email
 * @property string $other_contact_info
 * @property string $itinerary_quotation_english
 * @property string $itinerary_quotation_other_language
 * @property string $tour_schedule_note
 * @property string $note_for_guide
 * @property string $other_note
 * @property string $tour_price
 * @property string $payment
 * @property string $stage
 */
class OaTour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_tour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inquiry_id', 'tour_type'], 'required'],
            [['inquiry_id', 'vip', 'tour_type', 'number_of_travelers', 'agent', 'co_agent', 'operator'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['organization', 'traveler_info', 'other_contact_info', 'itinerary_quotation_english', 'itinerary_quotation_other_language', 'tour_schedule_note', 'note_for_guide', 'other_note'], 'string'],
            [['tour_price'], 'number'],
            [['inquiry_source', 'language', 'group_type', 'country', 'tour_start_date', 'tour_end_date', 'contact', 'payment', 'stage'], 'string', 'max' => 255],
            [['cities', 'email'], 'string', 'max' => 1024],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Tour ID'),
            'inquiry_id' => Yii::t('app', 'Inquiry ID'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'inquiry_source' => Yii::t('app', 'Inquiry Source'),
            'language' => Yii::t('app', 'Language'),
            'vip' => Yii::t('app', 'VIP'),
            'agent' => Yii::t('app', 'Agent'),
            'co_agent' => Yii::t('app', 'Co-Agent'),
            'operator' => Yii::t('app', 'Operator'),
            'tour_type' => Yii::t('app', 'Tour Type'),
            'group_type' => Yii::t('app', 'Group Type'),
            'country' => Yii::t('app', 'Country'),
            'organization' => Yii::t('app', 'Organization'),
            'number_of_travelers' => Yii::t('app', 'Number of Travelers'),
            'traveler_info' => Yii::t('app', 'Traveler Info'),
            'tour_start_date' => Yii::t('app', 'Tour Start Date'),
            'tour_end_date' => Yii::t('app', 'Tour End Date'),
            'cities' => Yii::t('app', 'Cities'),
            'contact' => Yii::t('app', 'Contact'),
            'email' => Yii::t('app', 'Email'),
            'other_contact_info' => Yii::t('app', 'Other Contact Info'),
            'itinerary_quotation_english' => Yii::t('app', 'Itinerary & Quotation - English'),
            'itinerary_quotation_other_language' => Yii::t('app', 'Itinerary & Quotation - Other Language'),
            'tour_schedule_note' => Yii::t('app', 'Tour Schedule Note'),
            'note_for_guide' => Yii::t('app', 'Note for Guide'),
            'other_note' => Yii::t('app', 'Other Note'),
            'tour_price' => Yii::t('app', 'Tour Price'),
            'payment' => Yii::t('app', 'Payment'),
            'stage' => Yii::t('app', 'Stage'),
        ];
    }
}
