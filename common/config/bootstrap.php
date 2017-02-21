<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@root', realpath(dirname(__FILE__).'/../../'));
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');

define('SITE_BASE_URL'   , 'http://www.demo.com');
define('UPLOADS_URL'   , SITE_BASE_URL.'/uploads/');

define('BIZ_TYPE_CITIES'   , 1);
define('BIZ_TYPE_TOUR'     , 2);
define('BIZ_TYPE_ITINERARY', 3);
define('BIZ_TYPE_ALBUM'    , 4);

define('TOUR_THEMES_MOST_POPULAR', 1);
define('TOUR_THEMES_FAMILY', 2);
define('TOUR_THEMES_CULTURE', 3);
define('TOUR_THEMES_ADVENTUROUS', 4);
define('TOUR_THEMES_FOODIE', 5);
define('TOUR_THEMES_AT_A_GLANCE', 6);
define('TOUR_THEMES_ROMANTIC', 7);
define('TOUR_THEMES_NATURE', 8);

define('TOUR_TYPE_NORMAL', 0);
define('TOUR_TYPE_GROUP', 1);

define('REC_TYPE_MUST_VISIT', 1);
define('REC_TYPE_POPULAR', 2);
define('REC_TYPE_OFF_THE_BEATEN_TRACK', 3);

define('ARTICLE_TYPE_ARTICLE', 1);
define('ARTICLE_TYPE_ADVERTISEMENT', 2);
define('ARTICLE_TYPE_FAQ', 3);
define('ARTICLE_TYPE_PREPARATION', 4);
define('ARTICLE_TYPE_PAGE', 5);

define('FAQ_TYPE_TRIP_PLANNING', 1);
define('FAQ_TYPE_IN_CHINA', 2);
define('FAQ_TYPE_FAQ', 3);

define('ALBUM_TYPE_SIGHT', 1);
define('ALBUM_TYPE_ACTIVITY', 2);

define('DIS_STATUS_SHOW', 1);
define('DIS_STATUS_HIDE', 0);

define('HOMEPAGE_TYPE_SLIDE', 1);
define('HOMEPAGE_TYPE_AD', 2);

define('FORM_TYPE_CUSTOM',      1);
define('FORM_TYPE_QUOTATION',   2);
define('FORM_TYPE_EDU',         3);
define('FORM_TYPE_MICE',        4);
define('FORM_TYPE_GROUP',       5);