<?php
namespace frontend\components;
require(dirname(__FILE__)."/../../common/models/Mobile_Detect.php");

use Yii;
use Mobile_Detect;

class FGlobalClass extends \yii\base\Component
{

    public function init()
    {
        $cookie_name_is_moible = '_is_moible';
        Yii::$app->params['is_mobile'] = 0;
        if (isset($_COOKIE[$cookie_name_is_moible])) {
            $cookie_is_mobile = $_COOKIE[$cookie_name_is_moible];
            if ($cookie_is_mobile == '1') {
                Yii::$app->params['is_mobile'] = 1;
            }
        }
        else
        {
            $Mobile_Detect = new Mobile_Detect();
            if ($Mobile_Detect->isMobile() && !$Mobile_Detect->isTablet()) {
                Yii::$app->params['is_mobile'] = 1;
            }
            setcookie($cookie_name_is_moible, Yii::$app->params['is_mobile'], time()+3600*24*365, '/');
        }

        $cookie_name_currency = '_currency';
        $currency = '';
        if (isset($_GET['currency'])) {
            $currency = $_GET['currency'];
        }
        if (!empty($currency) && array_key_exists($currency, Yii::$app->params['currency_name'])) {
            Yii::$app->params['currency'] = $currency;
            setcookie($cookie_name_currency, Yii::$app->params['currency'], time()+3600*24*365, '/');
        }
        else{
            if (!isset($_COOKIE[$cookie_name_currency])) {
                $cookie_currency = 'USD';
                setcookie($cookie_name_currency, $cookie_currency, time()+3600*24*365, '/');
            }
            else
            {
                $cookie_currency = strtoupper($_COOKIE[$cookie_name_currency]);
            }
            Yii::$app->params['currency'] = $cookie_currency;
        }

        if (!isset($_COOKIE['_language']))
        {
            //auto set language from browser
            // $supportedLanguages = Yii::$app->urlManager->languages;
            // $preferredLanguage = Yii::$app->request->getPreferredLanguage($supportedLanguages);
            // if (empty($preferredLanguage)) {
            //     $preferredLanguage = Yii::$app->sourceLanguage;
            // }
            // Yii::$app->language = $preferredLanguage;
        }


        if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'action=')===0){
            $query_string = $_SERVER['QUERY_STRING'];
            $url_dir = [
                'action=activity/greatWallOfChina' => '/destination/The-Great-Wall',
                'action=tour/view&tour_id=971' => '/experience/The-Best-of-Hangzhou',
                'action=tour/view&tour_id=90' => '/experience/Great-Wall-Mutianyu-and-the-Ming-Tombs',
                'action=tour/view&tour_id=87' => '/experience/Shanghai-plus-Suzhou-and-Hangzhou-Triangle',
                'action=tour/view&tour_id=841' => '/experience/Beijing-Highlights-and-Sleep-on-the-Wall',
                'action=tour/view&tour_id=79' => '/experience/Beijing-and-the-Great-Wall-in-One-Day',
                'action=tour/view&tour_id=68' => '/experience/Jinshanling-Great-Wall-Hike',
                'action=tour/view&tour_id=65' => '/experience/Jinshanling-Great-Wall-Hike',
                'action=tour/view&tour_id=5' => '/experience/Beijing-in-24-hours',
                'action=tour/view&tour_id=4093' => '/experience/Shanghai-plus-Suzhou-and-Hangzhou-Triangle',
                'action=tour/view&tour_id=4010' => '/experience/The-Golden-Triangle-Plus-Zhangjiajie',
                'action=tour/view&tour_id=3899' => '/experience/North-China-Culture-Adventure',
                'action=tour/view&tour_id=3854' => '/experience/The-Ancient-Capitals',
                'action=tour/view&tour_id=3678' => '/experience/Beijing-and-Tibet-Highlights-Tour',
                'action=tour/view&tour_id=34' => '/experience/Beijing-Four-Day-Experience',
                'action=tour/view&tour_id=2478' => '/experience/Shanghai-to-Beijing-in-48-Hours',
                'action=tour/view&tour_id=229' => '/experience/The-Ancient-Capitals',
                'action=tour/view&tour_id=2243' => '/experience/Beijing-and-Tibet-Highlights-Tour',
                'action=tour/view&tour_id=2240' => '/experience/Tibet-9-Day-Pilgrimage-and-Road-Trip',
                'action=tour/view&tour_id=223' => '/experience/Yangshuo-and-Longsheng-Rice-Terrace-Rural-Adventure',
                'action=tour/view&tour_id=22' => '/experience/Shanghai-Two-Day-Experience',
                'action=tour/view&tour_id=219' => '/experience/Yangtze-River-Cruise-and-China-Golden-Triangle',
                'action=tour/view&tour_id=216' => '/experience/Shanghai-plus-Suzhou-and-Hangzhou-Triangle',
                'action=tour/view&tour_id=213' => '/experience/Golden-Triangle-of-China',
                'action=tour/view&tour_id=21' => '/experience/Shanghai-One-Day-Experience',
                'action=tour/view&tour_id=193' => '/experience/China-Family-Journey',
                'action=tour/view&tour_id=180' => '/experience/Golden-Triangle-of-China',
                'action=tour/view&tour_id=164' => '/experience/The-Classic-China-Tour',
                'action=tour/view&tour_id=1504' => '/experience/Romantic-China-Journey',
                'action=tour/view&tour_id=15' => '/experience/Warriors-and-City-Sights',
                'action=tour/view&tour_id=1472' => '/experience/The-China-Highlights',
                'action=tour/view&tour_id=1465' => '/experience/Yangshuo-and-Longsheng-Rice-Terrace-Rural-Adventure',
                'action=tour/view&tour_id=1463' => '/experience/Yangshuo-and-Longsheng-Rice-Terrace-Rural-Adventure',
                'action=tour/view&tour_id=1444' => '/experience/Yangshuo-and-Longsheng-Rice-Terrace-Rural-Adventure',
                'action=tour/view&tour_id=14' => '/experience/Beijing-in-72-hours',
                'action=tour/view&tour_id=1389' => '/experience/Chengdu-Pandas-and-Giant-Buddha',
                'action=tour/view&tour_id=1388' => '/experience/Chengdu-Pandas-and-Giant-Buddha',
                'action=tour/view&tour_id=1387' => '/experience/Zoo-Keeping-at-Dujiangyan-Panda-Valley',
                'action=tour/view&tour_id=1386' => '/experience/Chengdu-Pandas-and-Giant-Buddha',
                'action=tour/view&tour_id=13' => '/experience/Beijing-in-48-hours',
                'action=tour/view&tour_id=124' => '/experience/Shanghai-plus-Suzhou-and-Hangzhou-Triangle',
                'action=tour/view&tour_id=1216' => '/experience/North-China-Culture-Adventure',
                'action=tour/view&tour_id=1213' => '/experience/Huangshan-and-Huizhou-Villages',
                'action=tour/view&tour_id=1205' => '/experience/North-China-Culture-Adventure',
                'action=tour/view&tour_id=1201' => '/experience/Huangshan-and-Huizhou-Villages',
                'action=tour/view&tour_id=107' => '/experience/China-Family-Journey',
                'action=tour/view&tour_id=106' => '/experience/Shanghai-plus-Suzhou-and-Hangzhou-Triangle',
                'action=tour/view&tour_id=105' => '/experience/The-Best-of-Hangzhou',
                'action=tour/view&tour_id=1010' => '/experience/The-Best-of-Hangzhou',
                'action=tour/list&city[]=4' => '/destination/Xi%27an/experiences',
                'action=tour/list&city[]=2' => '/destination/Beijing/experiences',
                'action=tour/list&city[]=19&city[]=3' => '/destination/Yangshuo/experiences',
                'action=tour/list&city[]=1' => '/destination/Shanghai/experiences',
                'action=tour/list&category=10' => '/experiences/Family-Vacation',
                'action=show/redTheaterKungfuShow' => '/activity/The-Legend-of-Kungfu',
                'action=show/pekingOperaLiyuan' => '/activity/Peking-Opera-Show',
                'action=show/pekingOperaHuguang' => '/activity/Peking-Opera-Show',
                'action=show/chaoyangAcrobatShow' => '/activity/Chaoyang-Acrobatic-Show',
                'action=preparation/whenToVisit' => '/preparation/When-to-visit',
                'action=preparation/visas' => '/preparation/Visas',
                'action=preparation/vaccination' => '/preparation/Health-and-Safety',
                'action=preparation/toilets' => '/preparation/Toilets',
                'action=preparation/shopping' => '/preparation/Shopping',
                'action=preparation/safety' => '/preparation/Health-and-Safety',
                'action=preparation/popularRoutes' => '/destinations',
                'action=preparation/phones' => '/preparation/Staying-Connected',
                'action=preparation/packing' => '/preparation/What-should-I-pack-and-bring-with-me%3F',
                'action=preparation/moneyManaging' => '/preparation/Cash-and-Credit-Cards',
                'action=preparation/moneyCurrencyConverter' => '/preparation/Chinese-Currency',
                'action=preparation/moneyCurrency' => '/preparation/Chinese-Currency',
                'action=preparation/moneyBargaining' => '/preparation/Should-I-bargain%3F',
                'action=preparation/meals' => '/preparation/Eating-and-Drinking',
                'action=preparation/maps' => '/preparation/Map+and+Navigation',
                'action=preparation/language' => '/preparation/Fast-facts',
                'action=preparation/internet' => '/preparation/Staying-Connected',
                'action=preparation/insurance' => '/preparation/Insurance',
                'action=preparation/handicapped' => '/preparation/Handicapped-Travellers',
                'action=preparation/gps' => '/preparation/Maps-and-Navigation',
                'action=preparation/electricity' => '/preparation/Electricity',
                'action=preparation/children' => '/preparation/Travel-With-Children',
                'action=preparation/airports' => '/preparation/China%27s-Major-Airports',
                'action=guide/list' => '/about-us/our-guides',
                'action=educationalProgram/index' => '/educational-programs',
                'action=city/view&city_id=9' => '/destination/Suzhou',
                'action=city/view&city_id=6' => '/destination/Pingyao',
                'action=city/view&city_id=57' => '/destination/Chengdu',
                'action=city/view&city_id=55' => '/sight/Longji-Rice-Terraces',
                'action=city/view&city_id=54' => '/destination/Huizhou-Villages',
                'action=city/view&city_id=4' => '/destination/Xi%27an',
                'action=city/view&city_id=3' => '/destination/Guilin',
                'action=city/view&city_id=25' => '/destination/Chengdu',
                'action=city/view&city_id=2' => '/destination/Beijing',
                'action=city/view&city_id=19' => '/destination/Yangshuo',
                'action=city/view&city_id=11' => '/destination/Tibet-%7C-Lhasa',
                'action=city/view&city_id=1' => '/destination/Shanghai',
                'action=admin/viewStaff' => '/about-us/meet-our-team',
                'action=activity/view&activity_id=97' => '/sight/ZhouZhuang-Water-Town',
                'action=activity/view&activity_id=95' => '/sight/Tongli-Water-Town',
                'action=activity/view&activity_id=76' => '/activity/Tang-Dynasty-Show-and-Dumpling-Dinner',
                'action=activity/view&activity_id=74' => '/destination/Suzhou',
                'action=activity/view&activity_id=710' => '/activity/Tai-Chi-class',
                'action=activity/view&activity_id=69' => '/destination/Suzhou',
                'action=activity/view&activity_id=648' => '/experience/Shanghai-plus-Suzhou-and-Hangzhou-Triangle',
                'action=activity/view&activity_id=634' => '/activity/Leshan-Giant-Buddha-boat-ride',
                'action=activity/view&activity_id=633' => '/sight/Leshan-Giant-Buddha',
                'action=activity/view&activity_id=623' => '/destination/Chengdu',
                'action=activity/view&activity_id=589' => '/destination/Huizhou-Villages',
                'action=activity/view&activity_id=580' => '/activity/Kungfu-Show-at-the-Shaolin-Temple',
                'action=activity/view&activity_id=542' => '/sight/Baisha-Old-Town',
                'action=activity/view&activity_id=541' => '/sight/Baisha-Old-Town',
                'action=activity/view&activity_id=529' => '/sight/Zhangbi-Underground-Castle',
                'action=activity/view&activity_id=517' => '/activity/Painting-or-Calligraphy-Class',
                'action=activity/view&activity_id=51' => '/activity/Impression-Liu-Sanjie-Night-Show',
                'action=activity/view&activity_id=5' => '/activity/Hutong-Rickshaw-Tour-with-local-family-visit',
                'action=activity/view&activity_id=493' => '/sight/Shanghai-Old-Street',
                'action=activity/view&activity_id=48' => '/sight/Temple-of-Heaven',
                'action=activity/view&activity_id=463' => '/sight/Golden-Whip-Stream-Trail',
                'action=activity/view&activity_id=43' => '/sight/798-Arts-District',
                'action=activity/view&activity_id=408' => '/activity/Impression-Lijiang-Show',
                'action=activity/view&activity_id=39' => '/sight/Muslim-Street',
                'action=activity/view&activity_id=377' => '/sight/Jade-Dragon-Snow-Mountain',
                'action=activity/view&activity_id=34' => '/destination/Xi%27an',
                'action=activity/view&activity_id=335' => '/activity/Kung-Fu-Class-Experience',
                'action=activity/view&activity_id=32' => '/sight/Qin-Shihuang%27s-Tomb',
                'action=activity/view&activity_id=30' => '/preparation/Shopping',
                'action=activity/view&activity_id=3' => '/sight/Summer-Palace',
                'action=activity/view&activity_id=298' => '/activity/Impression-West-Lake-Show',
                'action=activity/view&activity_id=29' => '/preparation/Shopping',
                'action=activity/view&activity_id=28' => '/preparation/Shopping',
                'action=activity/view&activity_id=27' => '/preparation/Shopping',
                'action=activity/view&activity_id=257' => '/sight/Shibao-Pagoda',
                'action=activity/view&activity_id=25' => '/sight/Great-Wall-Mutianyu-Section',
                'action=activity/view&activity_id=24' => '/sight/Jingshan-Park',
                'action=activity/view&activity_id=23' => '/sight/Summer-Palace',
                'action=activity/view&activity_id=220' => '/activity/Song-of-Everlasting-Sorrow',
                'action=activity/view&activity_id=213' => '/activity/Hike-from-Jinshanling-to-Jinshanling-East',
                'action=activity/view&activity_id=211' => '/activity/Hike-from-Gubeikou-to-Jinshanling',
                'action=activity/view&activity_id=21' => '/sight/Tiananmen-Square',
                'action=activity/view&activity_id=2' => '/sight/The-Forbidden-City',
                'action=activity/view&activity_id=19' => '/sight/Silk-Street',
                'action=activity/view&activity_id=186' => '/sight/Dujiangyan-Panda-Valley',
                'action=activity/view&activity_id=174' => '/sight/Reed-Flute-Cave',
                'action=activity/view&activity_id=171' => '/sight/Li-River-Cruise',
                'action=activity/view&activity_id=164' => '/destination/Xi%27an',
                'action=activity/view&activity_id=116' => '/preparation/Shopping',
                'action=aboutUs/officeLocation' => '/about-us/contact-us',
                'action=aboutUs/driversVehicles' => '/about-us/drivers-and-vehicles',
                'action=aboutUs/companyPolicies' => '/company-policies',

                'action=tour/' => '/experiences',
                'action=city/' => '/destinations',
                'action=activity/' => '/destinations',
                'action=hotel/' => '/destinations',
                'action=show/' => '/destinations',
                'action=preparation/' => '/preparation',
                'action=aboutUs/' => '/about-us',
            ];

            foreach ($url_dir as $key => $value) {
                if (strpos($query_string, $key) !== false) {
                    header("HTTP/1.1 301 Moved Permanently"); 
                    header("Location: ".SITE_BASE_URL."{$value}"); 
                    exit();
                }
            }

            // header("HTTP/1.1 301 Moved Permanently"); 
            // header("Location: ".SITE_BASE_URL.'/site/error');
            http_response_code(404);
            include(dirname(dirname(__DIR__)) . '/frontend/web/statics/pages/404.html');
            exit;
        }

        //temp language jump
        if(isset($_SERVER['REQUEST_URI']))
        {
            $supportedLanguages = Yii::$app->urlManager->languages;
            $url = $_SERVER['REQUEST_URI'];
            foreach ($supportedLanguages as $language) {
                $lang_path = "/{$language}/";
                if ((strpos($url, $lang_path) === 0 || "/{$language}" == $url) && $language != Yii::$app->sourceLanguage && strpos($url, 'secure-credit-card-form') === false) {
                    header('Location: http://'.$language.'.thechinaguide.com');
                    exit;
                }
            }

            $red_dir = [
                // 'promo-viajeros-callejeros=1' => '/',
                '/nightlife/houhai.html' => '/sight/Houhai-Lake',
                '/forbidden_city/forbidden_city_map_2.jpg' => '/sight/The-Forbidden-City',
                '/mp3' => '/',
                '/tcg2/tours/cc' => '/secure-credit-card-form',
                '/sleeponthewall' => '/experiences/Great-Wall-Hiking-and-Camping',
                '/experiences/Adventurous' => '/experiences/Adventure',
                '/experiences/Foodie' => '/experiences/Gourmet',
                '/experiences/At-a-Glance' => '/experiences/China-at-a-Glance',
                // 'theme-tour' => '/themed-tours',
                '/blogs' => '/the-china-guide-blog',
            ];
            foreach ($red_dir as $key => $value) {
                if (strpos($url, $key) === 0) {
                    header("HTTP/1.1 301 Moved Permanently"); 
                    header("Location: ".SITE_BASE_URL."{$value}"); 
                    exit();
                }
            }
            if (strpos($url, 'promo-viajeros-callejeros=1') !== false) {
                header("HTTP/1.1 301 Moved Permanently"); 
                header("Location: ".SITE_BASE_URL); 
                exit();
            }

            // if ($_SERVER['SERVER_NAME'] != SITE_SERVER_NAME) {
            //     header("HTTP/1.1 301 Moved Permanently"); 
            //     header("Location: ".SITE_BASE_URL.$url); 
            //     exit();
            // }
        }


        parent::init();
    }
}


