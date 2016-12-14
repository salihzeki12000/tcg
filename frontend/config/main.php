<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    // 'language'=>'zh-CN',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            // 'suffix' => '.html',
            'rules' => [
                'experiences/type/<type:\d+>/page/<page:\d+>' => 'experience/index',
                'experiences/type/<type:\d+>' => 'experience/index',
                'experiences/theme/<theme:[A-Za-z0-9_\s]+>/page/<page:\d+>' => 'experience/index',
                'experiences/theme/<theme:[A-Za-z0-9_\s]+>' => 'experience/index',
                'experiences/page/<page:\d+>' => 'experience/index',
                'experiences' => 'experience/index',
                // 'experience/<id:\d+>' => 'experience/view',
                'experience/<name:[A-Za-z0-9_\'\s\-]+>' => 'experience/view',
                'destinations' => 'destination/index',
                'destination/<name:[A-Za-z0-9_\']+>' => 'destination/view',
                'destination/<name:[A-Za-z0-9_\']+>/<action:\w+>/page/<page:\d+>' => 'destination/<action>',
                'destination/<name:[A-Za-z0-9_\']+>/<action:\w+>' => 'destination/<action>',
                'sight/<name:[A-Za-z0-9_\'\s\-]+>' => 'sight/view',
                'articles' => 'article/index',
                'article/<title:[A-Za-z0-9_\'\s\-\?]+>' => 'article/view',
                'faq' => 'faq/index',
                'faq/<title:[A-Za-z0-9_\'\s\-\?]+>' => 'faq/view',

            ],
        ],


        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
                'power' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'power' => 'power.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
