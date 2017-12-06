<?php
return [
    'uploads_url' => UPLOADS_URL,
    'language_name' => array(
        'en' => 'English',
        'fr' => 'Français',
        'es' => 'Español',
        'de' => 'Deutsch',
        'pt' => 'Português',
        ),
    'currency_name' => array(
        'CNY' => ['sign'=>'¥' ,'name'=>'CNY'],
        'USD' => ['sign'=>'$' ,'name'=>'USD'],
        'EUR' => ['sign'=>'€' ,'name'=>'EUR'],
        'GBP' => ['sign'=>'£' ,'name'=>'GBP'],
        ),
    'biz_type'    => array(
        BIZ_TYPE_CITIES     => 'cities',
        BIZ_TYPE_TOUR       => 'tour',
        BIZ_TYPE_ITINERARY  => 'itinerary',
        BIZ_TYPE_ALBUM      => 'album',
        ),

    'rec_type' => array(
        REC_TYPE_MUST_VISIT           => Yii::t('app', 'Must Visit'),
        REC_TYPE_POPULAR              => Yii::t('app', 'Popular'),
        REC_TYPE_OFF_THE_BEATEN_TRACK => Yii::t('app', 'Off the Beaten Track'),
        ),
    'tour_themes' => array(
        // TOUR_THEMES_MOST_POPULAR => Yii::t('app', 'Most Popular'),
        TOUR_THEMES_FAMILY       => Yii::t('app', 'Family Vacation'),
        TOUR_THEMES_CULTURE      => Yii::t('app', 'Chinese Culture'),
        TOUR_THEMES_ADVENTUROUS  => Yii::t('app', 'Adventurous'),
        TOUR_THEMES_FOODIE       => Yii::t('app', 'Gourmet'),
        TOUR_THEMES_AT_A_GLANCE  => Yii::t('app', 'At a Glance'),
        TOUR_THEMES_ROMANTIC     => Yii::t('app', 'Romantic'),
        TOUR_THEMES_NATURE       => Yii::t('app', 'Nature'),
        // TOUR_THEMES_CRUISE      => Yii::t('app', 'Cruise'),
        ),
    'months' => array(
        1 => 'Jan',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Apr',
        5 => 'May',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Aug',
        9 => 'Sep',
        10 => 'Oct',
        11 => 'Nov',
        12 => 'Dec',
        ),
    'article_type' => array(
        ARTICLE_TYPE_ARTICLE        => Yii::t('app', 'Article'),
        ARTICLE_TYPE_ADVERTISEMENT  => Yii::t('app', 'Advertisement'),
        ARTICLE_TYPE_FAQ            => Yii::t('app', 'FAQ'),
        ARTICLE_TYPE_PREPARATION    => Yii::t('app', 'Preparation'),
        ),
    'faq_type' => array(
        FAQ_TYPE_TRIP_PLANNING => Yii::t('app', 'Before You Leave'),
        FAQ_TYPE_IN_CHINA      => Yii::t('app', 'During Your Trip'),
        FAQ_TYPE_FAQ        => Yii::t('app', 'FAQ'),
        FAQ_CHINESE_CULTURE => Yii::t('app', 'Chinese Culture'),
        ),
    'album_type' => array(
        ALBUM_TYPE_SIGHT    => Yii::t('app', 'sight'),
        ALBUM_TYPE_ACTIVITY => Yii::t('app', 'activity'),
        ),
    'dis_status' => array(
        DIS_STATUS_SHOW => 'Show',
        DIS_STATUS_HIDE => 'Hide',
        ),
    'yes_or_no' => array(
        0 => 'No',
        1 => 'Yes',
        ),
    'card_status' => array(
        CARD_STATUS_CHARGED     => 'To be Charged',
        CARD_STATUS_SUCCESSFULY => 'Successfuly Charged',
        CARD_STATUS_FAILED      => 'Charge Failed',
        ),
    'oa_book_cost_type' => array(
        OA_BOOK_COST_TYPE_GUIDE     => 'Guide',
        OA_BOOK_COST_TYPE_HOTEL     => 'Hotel',
        OA_BOOK_COST_TYPE_AGENCY    => 'Agency',
        OA_BOOK_COST_TYPE_OTHER     => 'Other Cost',
        ),
    'form_types' => array(
        FORM_TYPE_CUSTOM => 'Custom',
        FORM_TYPE_QUOTATION => 'Standard',
        FORM_TYPE_EDU => 'Education',
        FORM_TYPE_MICE => 'MICE',
        FORM_TYPE_GROUP => 'GroupTour',
        ),
    'form_required' => array(
        FORM_TYPE_CUSTOM => array(
            'arrival_date',
            'tour_length',
            'adults',
            'group_type',
            'name',
            'email',
            'nationality',
            'prefered_travel_agent',
        ),
        FORM_TYPE_QUOTATION => array(
            'arrival_date',
            'adults',
            'book_hotels',
            'name',
            'email',
            'nationality',
            'prefered_travel_agent',
        ),
        FORM_TYPE_EDU => array(
            'subject_program',
            'participants_number',
            'arrival_date',
            'tour_length',
            'ideas',
            'name',
            'email',
            'school_name',
            'position',
        ),
        FORM_TYPE_MICE => array(
            'subject_program',
            'participants_number',
            'arrival_date',
            'tour_length',
            'ideas',
            'name',
            'email',
            'company_name',
            'position',
        ),
        FORM_TYPE_GROUP => array(
            'adults',
            'name',
            'email',
            'nationality',
            'prefered_travel_agent',
        ),
    ),
    'form_fields' => array(
        FORM_TYPE_CUSTOM => array(
            'arrival_date',
            'arrival_city',
            'tour_length',
            'adults',
            'children',
            'infants',
            'group_type',
            'cities_plan',
            'travel_interests',
            'prefered_budget',
            'additional_information',
            'name_prefix',
            'name',
            'email',
            'nationality',
            'skype_name',
            'phone_number',
            'prefered_travel_agent',
        ),
        FORM_TYPE_QUOTATION => array(
            'tour_code',
            'tour_name',
            'tour_type',
            'arrival_date',
            'arrival_city',
            'adults',
            'children',
            'infants',
            'book_hotels',
            'hotel_preferences',
            'room_requirements',
            'additional_information',
            'name_prefix',
            'name',
            'email',
            'nationality',
            'skype_name',
            'phone_number',
            'prefered_travel_agent',
        ),
        FORM_TYPE_EDU => array(
            'subject_program',
            'participants_number',
            'arrival_date',
            'arrival_city',
            'tour_length',
            'ideas',
            'name_prefix',
            'name',
            'email',
            'school_name',
            'position',
            'skype_name',
            'phone_number',
            'hear_about_us',
        ),
        FORM_TYPE_MICE => array(
            'subject_program',
            'participants_number',
            'arrival_date',
            'arrival_city',
            'tour_length',
            'ideas',
            'name_prefix',
            'name',
            'email',
            'company_name',
            'position',
            'skype_name',
            'phone_number',
            'hear_about_us',
        ),
        FORM_TYPE_GROUP => array(
            'tour_code',
            'tour_name',
            'tour_type',
            'adults',
            'children',
            'transport_info',
            'additional_information',
            'name_prefix',
            'name',
            'email',
            'nationality',
            'skype_name',
            'phone_number',
            'prefered_travel_agent',
        ),

    ),

];

