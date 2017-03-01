<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'language'=>'en',
    'sourceLanguage' => 'en',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','FGlobalClass'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                        'yii\web\JqueryAsset' => [
                            'js' => [
                                YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                            ]
                        ],
                        'yii\bootstrap\BootstrapAsset' => [
                            'css' => [
                                YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                            ]
                        ],
                        'yii\bootstrap\BootstrapPluginAsset' => [
                            'js' => [
                                YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                            ]
                        ]
            ],
        ],

        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en', 'fr', 'es', 'de', 'pt'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            // 'suffix' => '.html',
            'rules' => [
                'secure-credit-card-form/success' => 'form-card/success',
                'secure-credit-card-form' => 'form-card/create',
                'form-submission/success' => 'form-info/success',
                'form-submission' => 'form-info/create',
                'experiences/search' => 'experience/search',
                'experiences/city/<city_name:[A-Za-z0-9_\'\s\|\-]+>/page/<page:\d+>' => 'experience/index',
                'experiences/city/<city_name:[A-Za-z0-9_\'\s\|\-]+>' => 'experience/index',
                'experiences/page/<page:\d+>' => 'experience/index',
                'experiences/<theme:[A-Za-z0-9_\s\-]+>/page/<page:\d+>' => 'experience/index',
                'experiences/<theme:[A-Za-z0-9_\s\-]+>' => 'experience/index',
                'experiences' => 'experience/index',
                'experience/<url_id:[A-Za-z0-9_\'\s\-]+>' => 'experience/view',
                'themed-tours' => 'join-a-group/index',
                'themed-tours/page/<page:\d+>' => 'join-a-group/index',
                'themed-tours/<url_id:[A-Za-z0-9_\'\s\-]+>' => 'join-a-group/view',
                'destinations' => 'destination/index',
                'destination/<url_id:[A-Za-z0-9_\'\s\|\-]+>' => 'destination/view',
                'destination/<url_id:[A-Za-z0-9_\'\s\|\-]+>/<action:\w+>/page/<page:\d+>' => 'destination/<action>',
                'destination/<url_id:[A-Za-z0-9_\'\s\|\-]+>/<action:\w+>' => 'destination/<action>',
                'sight/<url_id:[A-Za-z0-9_\'\s\-]+>' => 'sight/view',
                'activity/<url_id:[A-Za-z0-9_\'\s\-]+>' => 'activity/view',
                'the-china-guide-blog' => 'article/index',
                'blog/<url_id:[A-Za-z0-9_\'\s\-\?]+>' => 'article/view',
                'misc/<url_id:[A-Za-z0-9_\'\s\-\?]+>' => 'misc/view',
                'preparation' => 'preparation/index',
                'preparation/<url_id:[A-Za-z0-9_\'\s\-\?]+>' => 'preparation/view',
                'company-policies' => 'about-us/company-policies',
                'sitemap.xml' => 'sitemap/index',
                // 'site/currency/<currency:\w+>' => 'site/currency',
            ],
        ],


        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'FGlobalClass'=>[
            'class'=>'frontend\components\FGlobalClass',
        ],
    ],
    'params' => $params,
];
