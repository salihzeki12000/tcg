<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form_info".
 *
 * @property integer $id
 * @property string $arrival_date
 * @property string $arrival_city
 * @property string $departure_date
 * @property string $departure_city
 * @property string $adults
 * @property string $children
 * @property string $infants
 * @property string $guest_information
 * @property string $group_type
 * @property string $cities_plan
 * @property string $travel_interests
 * @property string $prefered_budget
 * @property string $additional_information
 * @property string $name_prefix
 * @property string $name
 * @property string $email
 * @property string $nationality
 * @property string $prefered_travel_agent
 * @property string $tour_code
 * @property string $tour_name
 * @property string $book_hotels
 * @property string $hotel_preferences
 * @property string $room_requirements
 * @property string $subject_program
 * @property string $participants_number
 * @property string $ideas
 * @property string $school_name
 * @property string $position
 * @property string $phone_number
 * @property string $hear_about_us
 * @property string $purpose_trip
 * @property string $number_participants
 * @property string $ideas_trip
 * @property string $company_name
 * @property integer $type
 * @property string $create_time
 * @property string transport_info
 * @property string other_info
 * @property integer tour_type
 * @property integer status
 * @property integer tour_id
 * @property integer skype_name


*/
class FormInfo extends \yii\db\ActiveRecord
{
    public $form_type;

    public function __construct($form_type=FORM_TYPE_CUSTOM)
    {
       $this->form_type = $form_type;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $arr_required = Yii::$app->params['form_required'][$this->form_type];
        return [
            [$arr_required, 'required' , 'message' => Yii::t('app', 'Required')],
            [['arrival_city', 'departure_city', 'adults', 'children', 'infants', 'group_type', 'cities_plan', 'travel_interests', 'prefered_budget', 'name_prefix', 'prefered_travel_agent', 'book_hotels', 'hotel_preferences'], 'string'],
            [['arrival_date', 'departure_date', 'nationality', 'tour_code', 'number_participants', 'tour_length'], 'string', 'max' => 20],
            [['guest_information', 'additional_information', 'room_requirements', 'ideas', 'ideas_trip', 'transport_info', 'other_info', 'tour_name', 'skype_name'], 'string', 'max' => 255],
            [['name', 'subject_program', 'participants_number', 'school_name', 'position', 'phone_number', 'hear_about_us', 'purpose_trip', 'company_name', 'email', 'promotion_code'], 'string', 'max' => 50],
            ['email', 'email'],
            [['type', 'tour_type','status', 'tour_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'arrival_date' => Yii::t('app', 'Arrival date'),
            'arrival_city' => Yii::t('app', 'Arrival city'),
            'departure_date' => Yii::t('app', 'Departure date'),
            'departure_city' => Yii::t('app', 'Departure city'),
            'adults' => Yii::t('app', 'Adults (> 12 yrs)'),
            'children' => Yii::t('app', 'Children (2 - 12 yrs)'),
            'infants' => Yii::t('app', 'Infants (< 2 yrs)'),
            'guest_information' => Yii::t('app', 'Travelers'),
            'group_type' => Yii::t('app', 'Group type'),
            'cities_plan' => Yii::t('app', 'Destinations that you plan to visit'),
            'travel_interests' => Yii::t('app', 'Travel interests'),
            'prefered_budget' => Yii::t('app', 'Budget (per person)'),
            'additional_information' => Yii::t('app', 'Anything else you think we should know?'),
            'name_prefix' => Yii::t('app', 'Name prefix'),
            'name' => Yii::t('app', 'Your full name'),
            'email' => Yii::t('app', 'Your email'),
            'nationality' => Yii::t('app', 'Your nationality'),
            'prefered_travel_agent' => Yii::t('app', 'Preferred travel agent'),
            'tour_code' => Yii::t('app', 'Tour code'),
            'tour_name' => Yii::t('app', 'Tour name'),
            'book_hotels' => Yii::t('app', 'Do you want us to book hotels for you?'),
            'hotel_preferences' => Yii::t('app', 'Hotel preferences'),
            'room_requirements' => Yii::t('app', 'Room requirements'),
            'subject_program' => Yii::t('app', 'Subject of your program'),
            'participants_number' => Yii::t('app', 'Estimated number of participants'),
            'ideas' => Yii::t('app', 'Rough outline of your program'),
            'school_name' => Yii::t('app', 'Name of your organization'),
            'position' => Yii::t('app', 'Your position'),
            'phone_number' => Yii::t('app', 'Your cellphone number'),
            'hear_about_us' => Yii::t('app', 'How did you hear about us?'),
            'purpose_trip' => Yii::t('app', 'Purpose of your trip'),
            'number_participants' => Yii::t('app', 'Number of participants'),
            'ideas_trip' => Yii::t('app', 'Your ideas about the trip'),
            'company_name' => Yii::t('app', 'Name of your organization'),
            'type' => Yii::t('app', 'Type'),
            'create_time' => Yii::t('app', 'Create time'),
            'transport_info' => Yii::t('app', 'Ship or flight information'),
            'other_info' => Yii::t('app', 'Anything else you think we should know?'),
            'tour_type' => Yii::t('app', 'Tour type'),
            'tour_length' => Yii::t('app', 'Tour length'),
            'promotion_code' => Yii::t('app', 'Promotion Code'),
            'status' => Yii::t('app', 'Status'),
            'tour_id' => Yii::t('app', 'Tour Id'),
            'skype_name' => Yii::t('app', 'Skype name'),
        ];
    }
}
