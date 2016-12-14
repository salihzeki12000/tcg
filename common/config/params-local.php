<?php
return [
    'uploads_url' => UPLOADS_URL,
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
        TOUR_THEMES_MOST_POPULAR => 'Most Popular',
        TOUR_THEMES_FAMILY       => 'Family Vacation',
        TOUR_THEMES_CULTURE      => 'Chinese Culture',
        TOUR_THEMES_ADVENTUROUS  => 'Adventurous',
        TOUR_THEMES_FOODIE       => 'Foodie',
        TOUR_THEMES_AT_A_GLANCE  => 'At a Glance',
        // TOUR_THEMES_NATURE      => 'Nature',
        // TOUR_THEMES_CRUISE      => 'Cruise',
        // TOUR_THEMES_ROMANTIC    => 'Romantic',
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
        ARTICLE_TYPE_ARTICLE        => 'Article',
        ARTICLE_TYPE_ADVERTISEMENT  => 'Advertisement',
        ARTICLE_TYPE_FAQ            => 'FAQ',
        ARTICLE_TYPE_PREPARATION    => 'Preparation',
        ),
    'faq_type' => array(
        FAQ_TYPE_TRIP_PLANNING => 'Trip Planning',
        FAQ_TYPE_IN_CHINA      => 'In China',
        ),
    'album_type' => array(
        ALBUM_TYPE_SIGHT    => 'sight',
        ALBUM_TYPE_ACTIVITY => 'activity',
        ),
    'dis_status' => array(
        DIS_STATUS_SHOW => 'Show',
        DIS_STATUS_HIDE => 'Hide',
        ),
];

