<?php
return [
    'language'=>'en',
    'sourceLanguage' => 'en',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
	'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@frontend/web/uploads/edt',
            'uploadUrl' => SITE_BASE_URL.'/uploads/edt',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
    'timeZone'=>'Asia/Chongqing',
];
